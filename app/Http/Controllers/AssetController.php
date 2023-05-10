<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetMiscStoreRequest;
use App\Http\Requests\AssetStoreRequest;
use App\Models\AssetModel;
use App\Models\GroupDetailModel;
use App\Models\GroupRightsModel;
use App\Models\User;
use App\Models\AssetCategory;
use App\Models\AssetDepartment;
use App\Models\AssetLocation;
use App\Models\AssetManufacturer;
use App\Models\AssetStatus;
use App\Models\Asset;
use App\Models\AssetRental;
use App\Models\LicenseRental;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;
use Illuminate\Support\Facades\Auth;


class AssetController extends Controller
{

    protected User $user;
    protected GroupRightsModel $groupRightsModel;
    protected GroupDetailModel $groupDetailModel;

    public function __construct(User $user, GroupRightsModel $groupRightsModel, GroupDetailModel $groupDetailModel)
    {
        $this->user = $user;
        $this->groupRightsModel = $groupRightsModel;
        $this->groupDetailModel = $groupDetailModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['assetaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Gegenstände Verwaltung";
        session()->remove('qrCode');
        $assets = Asset::all();

        if ($request->search) {
            $searchData = $request->search;
            $search = Asset::with(['model', 'category', 'status', 'manufacturer', 'location', 'department', 'rental'])
                ->wherehas('model', function ($query) use ($searchData) {
                    $query->where('name', 'LIKE', '%' . $searchData . '%');
                })
                ->orWherehas('category', function ($query) use ($searchData) {
                    $query->where('name', 'LIKE', '%' . $searchData . '%');
                })
                ->orWherehas('status', function ($query) use ($searchData) {
                    $query->where('name', 'LIKE', '%' . $searchData . '%');
                })
                ->orwherehas('manufacturer', function ($query) use ($searchData) {
                    $query->where('name', 'LIKE', '%' . $searchData . '%');
                })
                ->orwherehas('location', function ($query) use ($searchData) {
                    $query->where('room', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('storageplace', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('street', 'LIKE', '%' . $searchData . '%')
                        ->orWhere('postalcode', 'LIKE', '%' . $searchData . '%');
                })
                ->orwherehas('department', function ($query) use ($searchData) {
                    $query->where('name', 'LIKE', '%' . $searchData . '%');
                })
                ->orWhere('assets.id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('assets.customname', 'LIKE', '%' . $request->search . '%')
                ->get();
            if (empty($search[0])) {
                return redirect()->route("inventory.assets.dashboard")->with("info", "Es konnte kein Gegenstand unter \"" . $request->search . "\" gefunden werden!");
            } else {
                $assets = $search;
            }
        }

        if ($this->groupRightsModel->checkIfAnyRight(['fullaccess'])) return view('inventory.assets.dashboard', compact('assets', 'pageTitle'));

        $groups = $this->groupDetailModel->getGroup(Auth::user()->id);
        $countAssets = count($assets);
        $countGroups = count($groups);
        for ($i = 0; $i < $countAssets; $i++) {
            for ($j = 0; $j < $countGroups; $j++) {
                if ($assets[$i]->department->name == $groups[$j]['gruppe']) {
                    break;
                }
                if ($j == $countGroups - 1) {
                    unset($assets[$i]);
                }
            }
        }

        if (count($assets) < 1) return view('inventory.assets.dashboard', compact('assets', 'pageTitle'));

        return view('inventory.assets.dashboard', compact('assets', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createasset', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neuen Gegenstand erstellen";
        $categories = AssetCategory::all();
        $manufacturers = AssetManufacturer::all();
        $statuses = AssetStatus::all();
        $locations = AssetLocation::all();
        $departments = AssetDepartment::all();
        $models = AssetModel::all();
        $users = User::all();
        return view("inventory.assets.create", compact('pageTitle', 'categories', 'manufacturers', 'statuses', 'locations', 'departments', 'models', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store(AssetStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createasset', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if (Asset::where('id', $request->id)->exists()) {
            return redirect()->back()->withInput($request->post())->with("error", ConfigController::ASSETIDALREADYUSED);
        }
        if ($request->purchasecost != NULL) $request->request->set('purchasecost', str_replace(',', '.', $request->purchasecost));
        if ($request->monthprice != NULL) $request->request->set('monthprice', str_replace(',', '.', $request->monthprice));

        Asset::create($request->all());
        event(new LogActionEvent(ConfigController::LOGSCREATE, 'assets', $request->id));
        if (!in_array($request->user_id, [ConfigController::STORAGEUSER])) {
            AssetRental::create([
                'asset_id' => $request->id,
                'user_id' => $request->user_id
            ]);
            event(new LogActionEvent(ConfigController::LOGSASSIGNASSET, 'asset_rentals', $request->id));
        }
        return redirect()->route("inventory.assets.dashboard")->with("success", ConfigController::ASSETCREATESUCCESS);
    }

    public function storeMisc(AssetMiscStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createasset', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if (Asset::where('id', $request->id)->exists()) {
            return redirect()->back()->withInput($request->post())->with("error", ConfigController::ASSETIDALREADYUSED);
        }
        if ($request->purchasecost != NULL) $request->request->set('purchasecost', str_replace(',', '.', $request->purchasecost));
        Asset::create($request->all());
        event(new LogActionEvent(ConfigController::LOGSCREATE, 'assets', $request->id));
        if (!in_array($request->user_id, [ConfigController::STORAGEUSER])) {
            AssetRental::create([
                'asset_id' => $request->id,
                'user_id' => $request->user_id
            ]);
            event(new LogActionEvent(ConfigController::LOGSASSIGNASSET, 'asset_rentals', $request->id));
        }
        return redirect()->route("inventory.assets.dashboard")->with("success", ConfigController::ASSETCREATESUCCESS);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['fullaccess', 'dashboardaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Asset Übersicht: ' . $asset['name'];
        $user = AssetRental::join('assets', 'assets.id', 'asset_rentals.asset_id')
            ->join('users', 'users.id', 'asset_rentals.user_id')
            ->where('assets.id', $asset->id)
            ->select('users.username', 'users.id as user_id','asset_rentals.id as rentalid')->get();

        $licenses = LicenseRental::join('licenses', 'licenses.id', 'license_rentals.license_id')
            ->join('assets', 'assets.id', 'license_rentals.asset_id')
            ->where('assets.id', $asset->id)
            ->select('licenses.*', 'license_rentals.id as licenserentalid')->get();
        return view("inventory.assets.info", compact('pageTitle', 'asset', 'user', 'licenses'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyasset', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $categories = AssetCategory::all();
        $manufacturers = AssetManufacturer::all();
        $statuses = AssetStatus::all();
        $locations = AssetLocation::all();
        $departments = AssetDepartment::all();
        $models = AssetModel::all();
        $users = User::all();
        $rental = AssetRental::where('asset_id', $asset->id)->get();
        isset($rental[0]) ? $asset['user_id'] = $rental[0]['user_id'] : $asset['user_id'] = ConfigController::STORAGEUSER;
        $pageTitle = "Gegenstand " . $asset->id . " bearbeiten";
        return view("inventory.assets.edit", compact('pageTitle', 'asset', 'categories', 'manufacturers', 'statuses', 'locations', 'departments', 'models', 'users', 'rental'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyasset', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $asset = Asset::find($id);
        if (Asset::where('id', $request->id)->exists() && ($asset->id != $request->id)) return redirect()->route('inventory.asset.edit', $id)->with('error', ConfigController::ASSETIDALREADYUSED);

        try {
            $rules = [
                'id' => ['regex:/^[1-9][0-9]{3,7}$/'],
                'purchasecost' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable'],
                'duration' => ['regex:/^[0-9]{1,9}$/', 'nullable'],
                'monthprice' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable'],
            ];
            $messages = [
                'id.regex' => 'Die ID muss eine 4 bis 8-stellige Zahl sein und kann nicht mit 0 starten!',
                'purchasecost.regex' => 'Der eingegebene Kaufpreis ist ungültig 00.00 oder 00,00 ',
                'duration.regex' => 'Geben Sie eine Ganze Zahl als Monat an',
                'monthprice.regex' => 'Der eingegebene Monatspreis ist ungültig 00.00 oder 00,00'
            ];
            $validate[] = Validator::make(['id' => $id], $rules, $messages);
            $validate[] = Validator::make(['purchasecost' => $request->purchasecost], $rules, $messages);
            $validate[] = Validator::make(['monthprice' => $request->monthprice], $rules, $messages);
            $validate[] = Validator::make(['duration' => $request->duration], $rules, $messages);
            foreach ($validate as $validation) {
                $errors = $validation->errors()->messages();
                if ($errors) {
                    foreach ($errors as $error) {
                        throw new Exception($error[0]);
                    }
                }
            }

        } catch (Exception $e) {
            return redirect()->back()->withInput($request->post())->with("error", $e->getMessage());
        }
        if ($request->purchasecost != NULL) $request->request->set('purchasecost', str_replace(',', '.', $request->purchasecost));
        if ($request->monthprice != NULL) $request->request->set('monthprice', str_replace(',', '.', $request->monthprice));

        $asset->id = $request->id;
        $asset->macaddress = $request->macaddress;
        $asset->serialnumber = $request->serialnumber;
        $asset->ordernumber = $request->ordernumber;
        $asset->warranty = $request->warranty;
        $asset->purchasedate = $request->purchasedate;
        $asset->monthprice = $request->monthprice;
        $asset->duration = $request->duration;
        $asset->purchaselink = $request->purchaselink;
        $asset->model_id = $request->model_id;
        $asset->category_id = $request->category_id;
        $asset->manufacturer_id = $request->manufacturer_id;
        $asset->status_id = $request->status_id;
        $asset->location_id = $request->location_id;
        $asset->department_id = $request->department_id;
        $asset->save();


        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'assets', $request->id));

        if (in_array($request->user_id, [ConfigController::STORAGEUSER])) {
            AssetRental::where('asset_id', $request->id)->delete();
            event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_rentals', $request->id));
        } else {
            if (AssetRental::where('asset_id', $request->id)->exists()) {
                AssetRental::where('asset_id', $request->id)->update([
                    'user_id' => $request->user_id
                ]);
                event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_rental', $request->id));

            } else {
                AssetRental::create([
                    'asset_id' => $request->id,
                    'user_id' => $request->user_id,
                ]);
                event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_rental', $request->id));
            }
        }

        return redirect()->route("inventory.assets.dashboard")->with("success", ConfigController::ASSETCHANGED);


    }

    public function updateMisc(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyasset', 'fullaccess', 'assetaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $asset = Asset::find($id);
        if (Asset::where('id', $request->id)->exists() && ($asset->id != $request->id)) return redirect()->route('inventory.asset.edit', $id)->with('error', ConfigController::ASSETIDALREADYUSED);

        try {
            $rules = [
                'id' => ['regex:/^[1-9][0-9]{3,7}$/'],
                'purchasecost' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable'],
            ];
            $messages = [
                'id.regex' => 'Die ID muss eine 4 bis 8-stellige Zahl sein und kann nicht mit 0 starten!',
                'purchasecost.regex' => 'Der eingegebene Kaufpreis ist ungültig 00.00 oder 00,00 ',
            ];
            $validate[] = Validator::make(['id' => $request->id], $rules, $messages);
            $validate[] = Validator::make(['purchasecost' => $request->purchasecost], $rules, $messages);

            foreach ($validate as $validation) {
                $errors = $validation->errors()->messages();
                if ($errors) {
                    foreach ($errors as $error) {
                        throw new Exception($error[0]);
                    }
                }
            }

        } catch (Exception $e) {
            return redirect()->back()->withInput($request->post())->with("error", $e->getMessage());
        }

        if ($request->purchasecost != NULL) $request->purchasecost = str_replace(',', '.', $request->purchasecost);

        $asset->id = $request->id;
        $asset->macaddress = $request->macaddress;
        $asset->serialnumber = $request->serialnumber;
        $asset->ordernumber = $request->ordernumber;
        $asset->warranty = $request->warranty;
        $asset->purchasedate = $request->purchasedate;
        $asset->monthprice = $request->monthprice;
        $asset->duration = $request->duration;
        $asset->purchaselink = $request->purchaselink;
        $asset->model_id = $request->model_id;
        $asset->category_id = $request->category_id;
        $asset->manufacturer_id = $request->manufacturer_id;
        $asset->status_id = $request->status_id;
        $asset->location_id = $request->location_id;
        $asset->department_id = $request->department_id;
        $asset->save();


        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'assets', $request->id));

        if (in_array($request->user_id, [ConfigController::STORAGEUSER])) {
            AssetRental::where('asset_id', $request->id)->delete();
            event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_rentals', $request->id));

        } else {
            if (AssetRental::where('asset_id', $request->id)->exists()) {
                AssetRental::where('asset_id', $request->id)->update([
                    'user_id' => $request->user_id
                ]);
                event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_rental', $request->id));

            } else {
                AssetRental::create([
                    'asset_id' => $request->id,
                    'user_id' => $request->user_id,
                ]);
                event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_rental', $request->id));
            }
        }

        return redirect()->route("inventory.assets.dashboard")->with("success", ConfigController::ASSETCHANGED);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Asset $asset, Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['fullaccess', 'deleteasset'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        if(!empty($request->post('id'))) {
            foreach($request->Post('id') as $id) {
                if (LicenseRental::where('asset_id', $id)->exists()) return redirect()->route("inventory.assets.dashboard")->with("error", 'Es wurden nicht alle Objekte gelöscht: ' . ConfigController::ASSETGOTLICENSE);
                if (AssetRental::where('asset_id', $id)->exists()) return redirect()->route("inventory.assets.dashboard")->with("error", 'Es wurden nicht alle Objekte gelöscht: ' . ConfigController::ASSETRENTEDTOPERSON);
                Asset::destroy($id);
                event(new LogActionEvent(ConfigController::LOGSDELETE, 'assets', $id));
            }
        }
        else {
            if (LicenseRental::where('asset_id', $asset->id)->exists()) return redirect()->route("inventory.assets.dashboard")->with("error", ConfigController::ASSETGOTLICENSE);
            if (AssetRental::where('asset_id', $asset->id)->exists()) return redirect()->route("inventory.assets.dashboard")->with("error", ConfigController::ASSETRENTEDTOPERSON);
            $asset->delete();
            event(new LogActionEvent(ConfigController::LOGSDELETE, 'assets', $asset->id));
        }

        return redirect()->route("inventory.assets.dashboard")->with("success", ConfigController::ASSETDELETEDSUCCESS);
    }
}
