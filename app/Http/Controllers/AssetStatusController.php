<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetStatusStoreRequest;
use App\Models\AssetStatus;
use App\Models\Asset;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;

class AssetStatusController extends Controller
{


    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $rights) {
        $this->rights = $rights;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->rights->checkIfAnyRight(['statusaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Gegenstände Status Verwaltung";
        $statuses = AssetStatus::all();
        if($request->search){
            $search = AssetStatus::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if(empty($search[0])) {
                return redirect()->route("inventory.status.dashboard")->with("info", "Es konnte kein Status unter \"" .  $request->search . "\" gefunden werden!");
            }else{
                $statuses = $search;
            }
            return view("inventory.status.dashboard", compact("statuses","pageTitle"));
        }

        return view("inventory.status.dashboard", compact("statuses","pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->rights->checkIfAnyRight(['createstatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neuen Status erstellen";

        return view("inventory.status.create", compact("pageTitle"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetStatusStoreRequest $request)
    {
        if (!$this->rights->checkIfAnyRight(['createstatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetStatus::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_statuses', $request->name));

        return redirect()->route("inventory.status.dashboard")->with("success", ConfigController::ASSETDEPARTMENTCREATESUCCESS);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetStatus $assetstatus)
    {
        {
            if (!$this->rights->checkIfAnyRight(['modifystatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

            $pageTitle = "Status {$assetstatus->name} bearbeiten";

            return view("inventory.status.edit", compact("assetstatus", "pageTitle"));

        }
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
        if (!$this->rights->checkIfAnyRight(['modifystatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $assetstatus = AssetStatus::find($id);
        if(AssetStatus::where('name', $request->name)->exists() && ($assetstatus->name != $request->name)) return redirect()->route('inventory.status.edit', $id)->with('error', ConfigController::ASSETSTATUSALREADYEXIST);

        $assetstatus->name = $request->name;
        $assetstatus->color = $request->color;
        $assetstatus->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_statuses', $request->name));
        return redirect()->route("inventory.status.dashboard")->with("success", ConfigController::ASSETSTATUSCHANGED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetStatus $assetstatus)
    {
        if (!$this->rights->checkIfAnyRight(['deletestatus', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        if(Asset::where('status_id', $assetstatus->id)->exists()) return redirect()->route("inventory.status.dashboard")->with("error", ConfigController::ASSETSTATUSCANTDELETE);
        $assetstatus->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_statuses', $assetstatus->name));
        return redirect()->route("inventory.status.dashboard")->with("success", ConfigController::ASSETSTATUSDELETESUCCESS);
    }
}
