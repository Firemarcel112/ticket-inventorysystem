<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssetCategoryStoreRequest;
use App\Models\AssetCategory;
use App\Models\Asset;
use App\Models\GroupRightsModel;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;


class AssetCategoriesController extends Controller
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
        if (!$this->groupRightsModel->checkIfAnyRight(['categoriesaccess', 'fullaccess', 'dashboardaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Gegenstand Kategorie Verwaltung";
        $categories = AssetCategory::all();
        if($request->search) {
            $search = AssetCategory::where('name', 'LIKE', '%' . $request->search . '%')->get();
            if(empty($search[0])) {
                return redirect()->route("inventory.categories.dashboard")->with("info", "Es konnte keine Kategorie unter \"" .  $request->get('search') . "\" gefunden werden!");
            }else{
                $categories = $search;
            }
            return view("inventory.categories.dashboard", compact("categories", "pageTitle"));
        }

        return view("inventory.categories.dashboard", compact("categories",  "pageTitle"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createcategories', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Neue Kategorie erstellen";

        return view("inventory.categories.create", compact( "pageTitle"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(AssetCategoryStoreRequest $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['createcategories', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetCategory::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'asset_categories', $request->name));
        return redirect()->route("inventory.categories.dashboard")->with("success", ConfigController::CATEGORYCREATESUCCESS);
    }



    /**
     * Show the form for editing the specified resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(AssetCategory $assetcategory)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifycategories', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = "Kategorie {$assetcategory->name} bearbeiten";

        return view("inventory.categories.edit", compact("assetcategory", "pageTitle"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifycategories', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $assetcategory = AssetCategory::find($id);
        if(AssetCategory::where('name', $request->name)->exists() && ($assetcategory->name != $request->name)) return redirect()->route('inventory.categories.edit', $id)->with('error', ConfigController::CATEGORYALREADYEXIST);

        $assetcategory->name = $request->name;
        $assetcategory->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'asset_categories', $request->name));
        return redirect()->route("inventory.categories.dashboard")->with("success", ConfigController::CATEGORYCHANGED);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(AssetCategory $assetcategory)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deletecategories', 'fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(Asset::where('category_id', $assetcategory->id)->exists()) return redirect()->route("inventory.categories.dashboard")->with("error", ConfigController::CATEGORYASSETCANTDELETE);
        $assetcategory->delete();

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'asset_categories', $assetcategory->name));
        return redirect()->route("inventory.categories.dashboard")->with("success", ConfigController::CATEGORYDELETEDSUCCESS);
    }

}
