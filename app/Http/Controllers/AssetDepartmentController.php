<?php

namespace App\Http\Controllers;


use App\Http\Requests\AssetDepartmentStoreRequest;
use App\Models\AssetDepartment;
use App\Models\Asset;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;


class AssetDepartmentController extends Controller
{
    protected GroupRightsModel $groupRightsModel;


    public function __construct(GroupRightsModel $groupRightsModel) {
        $this->groupRightsModel = $groupRightsModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['departmentaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Abteilung Verwaltung";
        $departments = AssetDepartment::all();
        if($request->search){
            $search = AssetDepartment::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if(empty($search[0])) {
                return redirect()->route("inventory.department.dashboard")->with("info", "Es konnte keine Abteilungen unter \"" .  $request->get('search') . "\" gefunden werden!");
            }else{
                $departments = $search;
            }
            return view("inventory.department.dashboard", compact("departments","pageTitle"));
        }

        return view("inventory.department.dashboard", compact("departments","pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createdepartment', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neue Abteilung erstellen";

        return view("inventory.department.create", compact("pageTitle"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetDepartmentStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createdepartment', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetDepartment::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_departments', $request->name));
        return redirect()->route("inventory.department.dashboard")->with("success", ConfigController::ASSETDEPARTMENTCREATESUCCESS);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetDepartment $assetdepartment)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifydepartment', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Abteilung {$assetdepartment->name} bearbeiten";

        return view("inventory.department.edit", compact("assetdepartment", "pageTitle"));

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
        if (!$this->groupRightsModel->checkIfAnyRight(['modifydepartment', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $assetdepartment = AssetDepartment::find($id);
        if(AssetDepartment::where('name', $request->name)->exists() && ($assetdepartment->name != $request->name)) return redirect()->route('inventory.department.edit', $id)->with('error', ConfigController::ASSETDEPARTMENTALREADYEXIST);

        $assetdepartment->name = $request->name;
        $assetdepartment->color = $request->color;
        $assetdepartment->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_departments', $request->name));
        return redirect()->route("inventory.department.dashboard")->with("success", ConfigController::ASSETDEPARTMENTCHANGED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetDepartment $assetdepartment)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletedepartment', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        if(Asset::where('department_id', $assetdepartment->id)->exists()) return redirect()->route("inventory.department.dashboard")->with("error", ConfigController::ASSETDEPARTMENTCANTDELETE);
        $assetdepartment->delete();

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_department', $assetdepartment->name));
        return redirect()->route("inventory.department.dashboard")->with("success", ConfigController::ASSETDEPARTMENTDELETESUCCESS);
    }
}
