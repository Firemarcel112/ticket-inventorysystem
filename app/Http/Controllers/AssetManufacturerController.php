<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetManufacturerStoreRequest;
use App\Models\AssetManufacturer;
use App\Models\Asset;
use App\Models\License;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;

class AssetManufacturerController extends Controller
{
    protected GroupRightsModel $groupRightsModel;

    public function __construct(GroupRightsModel $groupRightsModel){
        $this->groupRightsModel = $groupRightsModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['manufactureraccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Hersteller Verwaltung";
        $manufacturers = AssetManufacturer::all();
        if ($request->search){
            $search = AssetManufacturer::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if(empty($search[0])) {
                return redirect()->route("inventory.manufacturer.dashboard")->with("info", "Es konnte keine Hersteller unter \"" .  $request->get('search') . "\" gefunden werden!");
            }
            else {
                $manufacturers = $search;
            }
            return view("inventory.manufacturer.dashboard", compact("manufacturers", "pageTitle"));
        }

        return view("inventory.manufacturer.dashboard", compact("manufacturers",  "pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createmanufacturer', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neuen Hersteller erstellen";

        return view("inventory.manufacturer.create", compact( "pageTitle"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetManufacturerStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createmanufacturer', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetManufacturer::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_manufacturers', $request->name));
        return redirect()->route("inventory.manufacturer.dashboard")->with("success", ConfigController::MANUFACTURERCREATESUCCESS);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetManufacturer $assetmanufacturer)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifymanufacturer', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Hersteller {$assetmanufacturer->name} bearbeiten";
        return view("inventory.manufacturer.edit", compact("assetmanufacturer", "pageTitle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifymanufacturer', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $assetmanufacturer = AssetManufacturer::find($id);
        if(AssetManufacturer::where('name', $request->name)->exists() && ($assetmanufacturer->name != $request->name)) return redirect()->route('inventory.manufacturer.edit', $id)->with('error', ConfigController::MANUFACTURERALREADYEXIST);

        $assetmanufacturer->name = $request->name;
        $assetmanufacturer->website = $request->website;
        $assetmanufacturer->email = $request->email;
        $assetmanufacturer->street = $request->street;
        $assetmanufacturer->postalcode = $request->postalcode;
        $assetmanufacturer->save();


        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_manufacturers', $request->name));
        return redirect()->route("inventory.manufacturer.dashboard")->with("success", ConfigController::MANUFACTURERCHANGED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetManufacturer $assetmanufacturer)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletemanufacturer', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(Asset::where('manufacturer_id', $assetmanufacturer->id)->exists() || License::where('manufacturer_id', $assetmanufacturer->id)->exists()) return redirect()->route("inventory.manufacturer.dashboard")->with("error", ConfigController::MANUFACTURERASSETCANTDELETE);
        $assetmanufacturer->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_manufacturers', $assetmanufacturer->name));
        return redirect()->route("inventory.manufacturer.dashboard")->with("success", ConfigController::MANUFACTURERDELETEDSUCCESS);

    }
}
