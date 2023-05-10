<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\GroupDetailModel;
use App\Models\GroupRightsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class LoginController extends Controller
{

    protected User $user;
    protected GroupRightsModel $rights;
    protected GroupDetailModel $groupDetailModel;

    public function __construct(User $user, GroupRightsModel $rights, GroupDetailModel $groupDetailModel) {
        $this->user = $user;
        $this->rights = $rights;
        $this->groupDetailModel = $groupDetailModel;

    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        return view('login');
    }

    /**
     * Function to log in
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */

    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // TODO IN function auslagern //
            //TODO GroupDetailModel mit GroupDetail ersetzen
            $findGroup = GroupDetailModel::where('userid', Auth::User()->id)->get();
            if(is_null($findGroup->first())) throw new Exception(ConfigController::USERHASNOGROUPS);
            //TODO GroupRightsModel mit GroupRight ersetzen
            $groups = GroupRightsModel::find($findGroup);
            //TODO Auslagern in Funktion //
            $assignedGroups = []; $i = 0;

            foreach($groups as $group) {
                $assignedGroups[$i] = $group->name;
                $i++;
            }
            //TODO ENDE Auslagern //

            session()->put([ "gruppe" => $assignedGroups]);

            return redirect()->route('index')->with('success', 'Hallo ' . Auth::user()->username);
        } else {
            return back()->with('error', ConfigController::WRONGUSERNAMEORPASSWORD);
        }
    }

    /**
     * Function for Logout (Destroys a Session)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("index")->with('success', ConfigController::LOGOUTSUCCESS);
    }
}
