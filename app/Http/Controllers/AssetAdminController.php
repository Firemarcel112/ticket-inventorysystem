<?php

namespace App\Http\Controllers;

use App\Models\AssetManufacturer;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;
use App\Models\Asset;
use App\Models\AssetRental;
use App\Models\GroupRightsModel;


class AssetAdminController extends Controller
{

    protected GroupRightsModel $groupRightsModel;

    public function __construct(GroupRightsModel $groupRightsModel)
    {

        $this->groupRightsModel = $groupRightsModel;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyasset', 'fullaccess', 'assetaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        if(AssetRental::where('asset_id', $asset->id)->exists()) {
            return redirect()->route('inventory.assets.dashboard')->with('error', ConfigController::ASSETRENTEDTOPERSON);
        }
        $users = User::all();
        $pageTitle = "Asset zuweisen: " . $asset->id . " | " . $asset->manufacturer->name . " " . $asset->model->name;
        return view("inventory.assets.assign", compact('pageTitle', 'users', 'asset'));


    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['modifyasset', 'fullaccess', 'assetaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $request->request->add(['asset_id' => $id]);
        AssetRental::create($request->all());
        event(new LogActionEvent(ConfigController::LOGSASSIGNASSET, 'asset_rentals', $id));

        return redirect()->route('inventory.assets.dashboard')->with('success', ConfigController::ASSETASSIGNSUCCESS);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$this->groupRightsModel->checkIfAnyRight(['deleteasset', 'fullaccess', 'assetaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        AssetRental::where('asset_id', $request->id)->delete();
        event(new LogActionEvent(ConfigController::LOGSUNASSIGNASSET, 'asset_rentals', $request->id));
        return redirect()->back()->with("success", ConfigController::ASSETREMOVEFROMUSER);

    }
}
