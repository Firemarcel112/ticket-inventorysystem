<?php

namespace App\Http\Controllers;

use App\Http\Requests\LicenseStoreRequest;
use App\Models\AssetManufacturer;
use App\Models\GroupRightsModel;
use App\Models\License;
use App\Models\LicenseRental;
use App\Events\LogActionEvent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LicenseController extends Controller
{

    protected GroupRightsModel $groupRightsModel;

    public function __construct(GroupRightsModel $groupRightsModel)
    {
        $this->groupRightsModel = $groupRightsModel;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['accesslicense', 'fullaccess', 'dashboardaccess', 'accesslicense'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Lizenzverwaltung";
        $licenses = License::all();
        $search = NULL;
        if ($request->search) {
            $search = License::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) return redirect()->route('inventory.license.dashboard')->with('info', "Es konnte keine Lizenzen unter \"" . $request->get('search') . "\" gefunden werden!");

            $licenses = $search;
            return view('inventory.license.dashboard', compact('licenses', 'pageTitle'));
        }
        return view('inventory.license.dashboard', compact('licenses', 'pageTitle', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createlicense', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neue Lizenz erstellen";

        $manufacturers = AssetManufacturer::all();

        return view("inventory.license.create", compact('pageTitle', 'manufacturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LicenseStoreRequest $request)
    {

        if ($request->purchaseprice != NULL) $request->request->set('purchaseprice', str_replace(',', '.', $request->purchaseprice));
        if ($request->monthprice != NULL) $request->request->set('monthprice', str_replace(',', '.', $request->monthprice));

        License::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'licenses', $request->name));
        return redirect()->route("inventory.license.dashboard")->with("success", ConfigController::LICENSECREATESUCCESS);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['accesslicense', 'dashboardaccess', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Lizenzinfos: ' . $license->name;
        $licenseRentalAssets = [];
        $rentalids = [];
        foreach ($license->rentals()->get() as $assets) {
            $rentalids[] = $assets;
            $licenseRentalAssets[] = $assets->asset;
        }
        return view("inventory.license.info", compact('pageTitle', 'license', 'licenseRentalAssets', 'rentalids'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifylicense', 'accesslicense', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Lizenz " . $license->name . " bearbeiten";
        $manufacturers = AssetManufacturer::all();
        return view("inventory.license.edit", compact('pageTitle', 'license', 'manufacturers'));
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
        if (!$this->groupRightsModel->checkIfAnyRight(['modifylicense', 'accesslicense', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $license = License::find($id);

        if ($request->total - LicenseRental::where('license_id', $id)->count() < 0) return redirect()->back()->with("error", ConfigController::LICENSETOTALLESSTHANUSAGE);


        if ($request->purchasecost == "") $request->request->set('purchasecost', 0);
        if ($request->total == "") $request->request->set('total', 0);
        if ($request->monthprice == "") $request->request->set('monthprice', 0);
        if ($request->duration == "") $request->request->set('duration', 0);

        $request->request->set('monthprice', str_replace(',', '.', $request->monthprice));
        $request->request->set('purchasecost', str_replace(',', '.', $request->purchasecost));

        try {
            $rules = [
                'purchasecost' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable'],
                'total' => ['regex:/^[0-9]{1,9}$/', 'nullable'],
                'duration' => ['regex:/^[0-9]{1,9}$/', 'nullable'],
                'monthprice' => ['regex:/^(\d*\,?.\d+|\d{1,3}(,\d{3})*(\.\d+)?)$/', 'nullable']
            ];
            $messages = [
                'purchaseprice.regex' => 'Der eingegebene Kaufpreis ist ungültig 00.00 oder 00,00 ',
                'total.regex' => 'Die Angegebene Anzahl entspricht keiner ganzen zahl!',
                'duration.regex' => 'Geben Sie eine Ganze Zahl als Monat an',
                'monthprice' => 'Der eingegebene Monatspreis ist ungültig 00.00 oder 00,00'
            ];

            $validate[] = Validator::make(['purchasecost' => $request->purchasecost], $rules, $messages);
            $validate[] = Validator::make(['total' => $request->total], $rules, $messages);
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
            return redirect()->back()->withInput($request->post())->with('error', $e->getMessage());
        }

        $license->update($request->all());

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'license', $request->name, $id));
        return redirect()->route("inventory.license.dashboard")->with("success", ConfigController::LICENSECHANGED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletelicense', 'accesslicense', 'fullaccess'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        if ($license->rentals()->first()) return redirect()->route("inventory.license.dashboard")->with("error", ConfigController::LICENSECANTDELETE);

        $license->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'licenses', $license->name));
        return redirect()->route("inventory.license.dashboard")->with("success", ConfigController::LICENSEDELETEDSUCCESS);
    }
}
