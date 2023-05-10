<?php

namespace App\Http\Controllers;

use App\Events\LogActionEvent;
use App\Http\Requests\UserUpdateSettingsRequest;
use App\Models\GroupDetailModel;
use App\Models\GroupRightsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected GroupRightsModel $rights;
    protected GroupDetailModel $group;

    public function __construct(GroupRightsModel $rights, GroupDetailModel $group)
    {
        $this->rights = $rights;
        $this->group = $group;
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function show($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        if (Auth::id() != $user->id) return redirect()->route('index')->with('error', ConfigController::NOACCESS);

        $pageTitle = $user->username . ' Einstellungen';

        return view("user.settings", compact("pageTitle", 'user'));

    }


    public function update(UserUpdateSettingsRequest $request, $id)
    {

        $user = User::find($id);

        $user->password = $request->password;
        $user->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'users', $user->username));


        return redirect()->route('user.settings', $user->id)->with('success', "Das Passwort wurde erfolgreich geändert!");


    }
}
