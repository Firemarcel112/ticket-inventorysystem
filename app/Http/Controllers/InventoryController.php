<?php

namespace App\Http\Controllers;


use App\Models\GroupRightsModel;
use App\Models\Asset;
use App\Models\License;
use App\Models\AssetStatus;
use App\Models\Log;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    protected GroupRightsModel $rights;

    public function __construct(GroupRightsModel $rights) {
        $this->rights = $rights;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (!$this->rights->checkIfAllRightsController(['fullaccess'])) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = 'Inventarisierungsdashboard';
        $activities = Log::where('tablename', 'assets')
            ->orWhere('tablename', 'assetmodel')
            ->orWhere('tablename', 'license')
            ->limit('20')->orderBy('created_at', 'DESC')->get();

        $assetstatuses = AssetStatus::all();
        $countAssets = Asset::count();
        $countLicenses = License::count();
        foreach($assetstatuses as $find) {
            $assetStatusCount[$find->name] = Asset::where('status_id', $find->id)->get();
            if(!$assetStatusCount[$find->name]) $assetStatusCount[$find->name] = 0; // false == 0
        }

        return view("inventory.dashboard", compact('pageTitle', 'assetstatuses', 'assetStatusCount', 'countAssets', 'countLicenses', 'activities'));
    }

}
