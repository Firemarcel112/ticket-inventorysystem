<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\GroupRightsModel;
use App\Models\License;
use App\Models\LicenseRental;
use Illuminate\Http\Request;
use App\Events\LogActionEvent;

class LicenseAdminController extends Controller
{

    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $rights)
    {
        $this->rights = $rights;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
        if (!$this->rights->checkIfAnyRight(['modifylicense', 'fullaccess', 'accesslicense'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Lizenz {$license->name} zuweisen";
        $assets = Asset::select("assets.*", "asset_models.name as modelname", "asset_manufacturers.name as manufacturername")
            ->join("asset_models", "assets.model_id", "asset_models.id")
            ->join("asset_manufacturers", "assets.manufacturer_id", "asset_manufacturers.id")
            ->get();
        $countResults = count($assets);
        for ($i = 0; $i < $countResults; $i++) {
            if (LicenseRental::where('asset_id', $assets[$i]['id'])->where('license_id', $license->id)->count() > 0) {
                unset($assets[$i]);
            }
        }
        if(count($assets) < 1) return redirect()->back()->with('error', ConfigController::NOASSETSREMAINING);

        return view('inventory.license.assign', compact('pageTitle', 'assets', 'license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$this->rights->checkIfAnyRight(['modifylicense', 'fullaccess', 'accesslicense'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);

        $license = License::find($request->id);

        if ($license->total - $license->rentals->count() < 1) return redirect()->back()->with('error', ConfigController::LICENSENOUSESLEFT);

        $request->request->add(['license_id' => $license->id]);

        LicenseRental::create($request->all());

        event(new LogActionEvent(ConfigController::LOGSLICENSEASSIGN, 'licneserental', $license->name));
        return redirect()->route("inventory.license.dashboard")->with('success', ConfigController::LICENSEASSIGNSUCCESS);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->rights->checkIfAnyRight(['deletelicense', 'fullaccess', 'accesslicense'])) return redirect()->route('dashboard')->with('error', ConfigController::NOACCESS);
        $licenseRental = LicenseRental::find($id);
        $license = License::find($licenseRental->license_id);

        $licenseRental->delete();
        event(new LogActionEvent(ConfigController::LOGSDELETE, 'licenserental', $license->name));
        return redirect()->back()->with("success", ConfigController::LICENSEREMOVEFROMASSET);
    }
}
