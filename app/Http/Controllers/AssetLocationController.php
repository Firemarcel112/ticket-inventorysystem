<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetLocationStoreRequest;
use App\Models\AssetLocation;
use App\Models\Asset;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;

class AssetLocationController extends Controller
{

    public function __construct( GroupRightsModel $groupRightsModel)
    {
        $this->groupRightsModel = $groupRightsModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['locationaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Orte Verwaltung";
        $locations = AssetLocation::all();
        if ($request->search) {
            $search =
                AssetLocation::where('room', 'LIKE', '%' . $request->search . '%')
                ->orWhere('storageplace', 'LIKE', '%' . $request->search . '%')
                ->orWhere('street', 'LIKE', '%' . $request->search . '%')
                ->orWhere('postalcode', 'LIKE', '%' . $request->search . '%')->get();
            if (empty($search[0])) {
                return redirect()->route("inventory.location.dashboard")->with("info", "Es konnte keine Orte unter \"" . $request->get('search') . "\" gefunden werden!");
            } else {
                $locations = $search;
            }
            return view("inventory.location.dashboard", compact("locations", "pageTitle"));
        }

        return view("inventory.location.dashboard", compact("locations", "pageTitle"));

    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createlocation', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neuen Ort erstellen";

        return view("inventory.location.create", compact("pageTitle"));
    }

    /**
     * Store a newly created resource in stor
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetLocationStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createlocation', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetLocation::create($request->all());

        $name = $request->street . " " . $request->room;
        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_locations', $name));
        return redirect()->route("inventory.location.dashboard")->with("success", ConfigController::ASSETLOCATIONCREATESUCCESS);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetLocation $assetlocation)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifylocation', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Ort {$assetlocation->street} bearbeiten";

        return view("inventory.location.edit", compact("assetlocation", "pageTitle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifylocation', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $assetlocation = AssetLocation::find($id);

        $assetlocation->room = $request->room;
        $assetlocation->storageplace = $request->storageplace;
        $assetlocation->street = $request->street;
        $assetlocation->postalcode = $request->postalcode;
        $assetlocation->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_locations', $id));
        return redirect()->route("inventory.location.dashboard")->with("success", ConfigController::ASSETLOCATIONCHANGED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetLocation $assetlocation)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletelocation', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(Asset::where('location_id', $assetlocation->id)->exists()) return redirect()->route("inventory.location.dashboard")->with("error", ConfigController::ASSETDEPARTMENTCANTDELETE);
        $assetlocation->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_locations', $assetlocation->id));
        return redirect()->route("inventory.location.dashboard")->with("success", ConfigController::ASSETLOCATIONDELETESUCCESS);

    }
}
