<?php

namespace App\Http\Controllers;

use App\Events\LogActionEvent;
use App\Http\Requests\UserUpdateRequest;
use App\Models\AssetRental;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Models\GroupRightsModel;
use App\Models\GroupDetailModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;


class UserAdminController extends Controller
{


    protected GroupRightsModel $rights;
    protected GroupDetailModel $group;

    public function __construct(GroupRightsModel $rights, GroupDetailModel $group)
    {
        $this->rights = $rights;
        $this->group = $group;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Benutzerverwaltung";
        $users = User::all();
        if ($request->search) {
            $search = User::where('username', 'LIKE', '%'.$request->search . '%')->orWhere('id', $request->search)->get();
            if (empty($search[0])) {
                return redirect()->route("admin.usermanagement")->with("info", "Es konnte keine Benutzer unter \"" .  $request->get('search') . "\" gefunden werden!");
            }
            else {
                $users = $search;
            }
        }
        return view("admin.usermanagement.management", compact("pageTitle", 'users'));



    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Benutzer erstellen";
        $groups = $this->rights->getAllGroups();
        $countGroups = count($groups);
        $result = [];
        for ($i = 0; $i < $countGroups; $i++) {
            $result[$i] = $groups[$i];
        }
        return view("admin.usermanagement.create", compact('result', 'pageTitle'));
    }

    /**
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        User::create($request->all());
        $username = $request->username;
        $group = $request->post("groupAdd");

        event(new LogActionEvent(ConfigController::LOGSCREATE, 'users', $username));


        try {
            $getCreatedUser = User::where('username', $username)->first();
        } catch (Exception $e) {
            User::where('username', $username)->delete();
            return redirect()->back()->with('error', 'Benutzer konnte nicht erstellt werden! Bitte versuchen Sie es erneut!');
        }
        if ($group != ConfigController::DEFAULTGROUP) {
            $this->group->addGroup($group, $getCreatedUser->id);
        }
        $this->group->addGroup(ConfigController::DEFAULTGROUP, $getCreatedUser->id);

        return redirect()->route("admin.usercreate")->with("success", "Der Benutzer wurde erstellt!");
    }


    /**
     * @param $username
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Benutzer: {$user->username} bearbeiten";
        $groups = $this->group->getGroup($user->id);
        if (empty($user)) {
            return redirect()->back()->with("500", "Server Fehler");
        }
        if (empty($groups)) {
            return redirect()->back()->with("500", "Server Fehler");
        }

        $existsGroups = $this->group->existGroup($user->id);

        return view("admin.usermanagement.edit", compact("user", "groups", "existsGroups", "pageTitle"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function update(UserUpdateRequest $request)
    {
        $oldUser = User::find($request->id);

        $groupAdd = $request->post("groupAdd");
        $groupRem = $request->post("groupRemove");

        $userCheck = is_null(User::where('username', $request->username)->first());


        if(!$userCheck && $request->username != $oldUser->username) {
            return redirect()->back()->with('error', ConfigController::USERNAMEEXIST);
        }

        if (!is_null($request->password)) {

            try {
                $rules = [
                    'password' => ['min:8', 'max:255', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 'confirmed']
                ];
                $messages = [
                    'password.confirmed' => 'Die Passwörter stimmen nicht überein!',
                    'password.min' => [
                        'string' => 'Das Passwort muss mindestens :min Zeichen enthalten!'
                    ],
                    'password.regex' => 'Das Passwort entspricht nicht den Sicherheitsanforderungen (Sonderzeichen, Groß und Kleinschreibung)',

                ];

                $validate[] = Validator::make(['password' => $request->password, 'password_confirmation' => $request->password_confirmation], $rules, $messages);

                foreach ($validate as $validation) {
                    $errors = $validation->errors()->messages();
                    if ($errors) {
                        foreach ($errors as $error) {
                            throw new Exception($error[0]);
                        }
                    }
                }

            } catch(Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }

            $user = User::find($request->id);
            $user->password = $request->password;
            $user->save();
        }

        $user = User::find($request->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        event(new LogActionEvent(ConfigController::LOGSUPDATE, 'users', $request->username));


        if ($groupAdd != 'none') $this->group->addGroup($groupAdd, $oldUser->id);

        if ($groupRem != 'none') $this->group->remGroupByUserID($oldUser->id, $groupRem);

        return redirect()->route("admin.usermanagement")->with('success', "Benutzer {$request->username} wurde bearbeitet!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $id = $request->userid;
        $username = User::find($id)->username;
        if(!$username) return redirect()->route('index')->with('error', ConfigController::USERNOTFOUND);
        if (in_array($id, ConfigController::SUPERUSERS)) return redirect()->route('index')->with('error', ConfigController::SUPERUSERCANTBEDELETED);
        if(AssetRental::where('user_id', $request->id)->exists()) return redirect()->route("admin.usermanagement")->with("error", ConfigController::USERRENTSASSET);

        $this->group->remGroupsFromUser($id);
        User::destroy($id);

        event(new LogActionEvent(ConfigController::LOGSDELETE, 'users', $username));
        return redirect()->route('admin.usermanagement')->with("success", "Der Benutzer: $username wurde gelöscht!");

    }



    public function importView()
    {
        if (!$this->rights->checkIfAllRightsController()) return redirect()->route('index')->with('error', ConfigController::NOACCESS);
        $pageTitle = "Benutzer Importieren";
        $groups = $this->rights->getAllGroups();
        return view("admin.usermanagement.import", compact("pageTitle", "groups"));
    }


    public function importStore(Request $request)
    {
        $filePath = $request->file('importFile')->getPathname();
        $file = fopen($filePath, 'r');
        $fileTyp = $request->file('importFile')->getClientOriginalExtension();

        if($fileTyp != 'csv') {
            return redirect()->route("admin.importuser")->with("error", "Dieser Datentyp wird nicht unterstützt");
        }
        while(($line = fgetcsv($file)) !== FALSE) {
            $result = explode(";", $line[0]);
            $result = str_replace([";", ",", "\""], "", $result);
            $users[] = [
                'username' => $result[1],
                'email' => $result[2],
                'password' => $result[3]
            ];
        }

        //Check ob alle Values aus der Datei die verification überstehen
        foreach($users as $user) {
            $user['username'];
            $user['email'];
            if(!$request->post('checkbox')) {
                $user['password'] = $request->post('password');
            }

            //Validation | Username 4-255 unique | Email unique | Password 8-255|  Sonderzeichen, groß, klein, zahl
            $rules = [
                'username' => ['max:255', 'min:4', 'unique:users,username'],
                'email' => ['required', 'unique:users', 'email'],
                'password' => ['required', 'min:8', 'max:255', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
            ];
            $messages = [
                'password.min' => [
                    'string' => 'Fehler beim Benutzer: ' . $user['username'] . ' Das Passwort muss mindestens :min Zeichen enthalten!',
                ],
                'username.min' => [
                    'string' => 'Fehler beim Benutzer: ' . $user['username'] . ' Der Benutzername muss mindestens :min Zeichen enthalten!',
                ],
                'password.required' => 'Fehler beim Benutzer: ' . $user['username'] . ' Das Passwort darf nicht leer sein!',
                'password.regex' => 'Fehler beim Benutzer: ' . $user['username'] . ' Das Passwort entspricht nicht den Sicherheitsanforderungen (Sonderzeichen, Groß und Kleinschreibung)',
                'username.unique' => 'Fehler beim Benutzer: ' . $user['username'] . ' Der Benutzername ist bereits vergeben!',
                'email.unique' => 'Fehler beim Benutzer: ' . $user['username'] . ' Die E-Mail Adresse existiert bereists',
            ];
            $validate = Validator::make($user, $rules, $messages);
            $errors = $validate->errors()->messages();
            if ($errors) {
                foreach ($errors as $error) {
                    return redirect()->back()->with('error', $error[0]);
                }
            };
        }

        //insert nachdem sie die verification überstanden haben
        foreach($users as $insertUser) {
            $username = $insertUser['username'];
            $email = $insertUser['email'];
            $group = $request->post('group');
            $password = $insertUser['password'];
            if(!$request->post('checkbox')) $password = $request->post('password');

            User::create([
                'username' => $username,
                'email' => $email,
                'password' => $password
            ]);

            $userid = User::where('username', $username)->first()->id;
            if($group != ConfigController::DEFAULTGROUP) {
                $this->group->addGroup($group, $userid);
            }
            $this->group->addGroup(ConfigController::DEFAULTGROUP, $userid);
        }
        return redirect()->route("admin.usermanagement")->with("success", "Alle Benutzer wurden erstellt!");

    }

}
