<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetRental;
use App\Models\assetRentalModel;
use App\Models\User;
use App\Models\GroupRightsModel;
use App\Models\GroupDetailModel;
use Illuminate\Http\Request;

class AssetPeopleController extends Controller {

    protected GroupRightsModel $rights;
    protected GroupDetailModel $group;


    public function __construct(GroupRightsModel $rights, GroupDetailModel $group)
    {
        $this->rights = $rights;
        $this->group = $group;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Personen Verwaltung";
        $users = User::all();

        if ($request->get("search")) {
            $search = User::where('username', 'LIKE',"%$request->search%")->orWhere('id', $request->search)->get();
            if (empty($search[0])) {
                return redirect()->route('inventory.people.dashboard')->with("info", "Es konnte keine Benutzer unter \"" .  $request->get('search') . "\" gefunden werden!");
            }
            else{
                $users = $search;
            }
            return view('inventory.people.dashboard', compact('users', 'pageTitle'));
        }
        return view('inventory.people.dashboard', compact('users', 'pageTitle'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $groups = $this->group->getGroup($user->id);
        $assets = AssetRental::where('user_id', $user->id)->get();

        $pageTitle = "Übersicht: ". $user->username;
        return view("inventory.people.info", compact('pageTitle', 'user', 'groups', 'assets'));
    }


}
