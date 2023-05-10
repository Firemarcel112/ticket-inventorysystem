<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetModelStoreRequest;
use App\Models\AssetModel;
use App\Models\Asset;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;

class AssetModelController extends Controller
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
        if (!$this->groupRightsModel->checkIfAnyRight(['modelaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Modelle Verwaltung";
        $models = AssetModel::all();
        if($request->search) {
            $search = AssetModel::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if(empty($search[0])) {
                return redirect()->route("inventory.model.dashboard")->with("info", "Es konnte keine Modelle unter \"" .  $request->get('search') . "\" gefunden werden!");
            }else{
                $models = $search;
            }
            return view("inventory.model.dashboard", compact("models", "pageTitle"));
        }
        return view("inventory.model.dashboard", compact("models",  "pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createmodel', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neues Modell erstellen";

        return view("inventory.model.create", compact( "pageTitle"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssetModelStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createmodel', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetModel::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_models', $request->name));
        return redirect()->route("inventory.model.dashboard")->with("success", ConfigController::MODELCREATESUCCESS);

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetModel $assetmodel)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifymodel', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(in_array($assetmodel->id, ConfigController::SUPERMODELS)) { return redirect()->route('inventory.model.dashboard')->with("error", ConfigController::MODELSUPERCANTDELETE); }

        $pageTitle = "Modell {$assetmodel->name} bearbeiten";
        return view("inventory.model.edit", compact("assetmodel", "pageTitle"));
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
        if (!$this->groupRightsModel->checkIfAnyRight(['modifymodel', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $assetmodel = AssetModel::find($id);
        if(AssetModel::where('name', $request->name)->exists() && ($assetmodel->name != $request->name)) return redirect()->route('inventory.model.edit', $id)->with('error', ConfigController::MODELALREADYEXIST);

        $assetmodel->name = $request->name;
        $assetmodel->website = $request->website;
        $assetmodel->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_models', $request->name));
        return redirect()->route("inventory.model.dashboard")->with("success", ConfigController::MODELCHANGED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetModel $assetmodel)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletemodel', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        if(in_array($assetmodel->id, ConfigController::SUPERMODELS)) { return redirect()->route('inventory.model.dashboard')->with("error", ConfigController::MODELSUPERCANTDELETE); }

        if(Asset::where('model_id', $assetmodel->id)->exists()) return redirect()->route("inventory.model.dashboard")->with("error", ConfigController::MODELCANTDELETE);
        $assetmodel->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_models', $assetmodel->name));
        return redirect()->route("inventory.model.dashboard")->with("success", ConfigController::MODELDELETEDSUCCESS);

    }
}
