<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Auth;

class GroupRightsModel extends Model
{
    use HasFactory;


    protected $table = "grouprights";
    protected $fillable = [
        "name",
        "isadmin",
        // Ticket //
        "openticket",
        "closeticket",
        "changeticketstatus",
        "modifyticketcategories",
        "readticket",
        "sendticketmessage",
        // Archive //
        "archiveacess",
        "deletearchive",
        // IVE //
        "fullacess",
        "dashboardaccess",
        // Manufacturer //
        "modifymanufacturer",
        "deletemanufacturer",
        "createmanufacturer",
        // Model //
        "modifymodel",
        "deletemodel",
        "createmodel",
        // Categories //
        "modifycategories",
        "deletecategories",
        "createcategories",
        // Location //
        "modifylocation",
        "deletelocation",
        "createlocation",
        // Status //
        "modifystatus",
        "deletestatus",
        "createstatus",
        // Departement //
        "modifydepartment",
        "deletedepartment",
        "createdepartment",
        // License //
        "accesslicense",
        "modifylicense",
        "deletelicense",
        "createlicense",
    ];


//    public function users() {
//        return $this->belongsToMany(User::class, 'groupdetails',
//            'userid', 'userid', 'userid', 'userid');
//    }

    /**
     * Gruppe auf Rechte prüfen<br>
     *  <b>Nur in einem View Verwendbar!</b>
     * @param $group
     * @param $right
     * @return bool
     */
    public static function check($userid, $right): bool
    {

        if (session()->has('id')) {
            $groupDetails = new GroupDetailModel();
            $groupDetailsTable = $groupDetails->getTable();
            $groupRights = new GroupRightsModel();
            $groupRightTable = $groupRights->getTable();
            $user = new User();
            $userTable = $user->getTable();
            $result = [];
            $count = count($right);
            for ($i = 0; $i < $count; $i++) {
                $result[] = $user->where("$userTable.id", $userid)
                    ->LeftJoin("$groupDetailsTable", "$userTable.id", "$groupDetailsTable.userid")
                    ->join("$groupRightTable", "$groupDetailsTable.groupid", "$groupRightTable.id")
                    ->select("$groupRightTable.name", "$groupRightTable.$right[$i]", "$groupRightTable.isadmin");

                foreach ($result[$i]->get()->all() as $permission) {
                    if ($permission['isadmin'] == "GRANT") {
                        return true;
                    }
                }

                $check = false;

                foreach ($result[$i]->get()->all() as $permission) {

                    if ($i == $count - 1) {
                        if ($permission[$right[$i]] == "GRANT") {
                            return true;
                        }
                    }
                    if ($permission[$right[$i]] == "GRANT") {
                        $check = true;
                    }

                }
                if (!$check) {
                    return false;
                }
            }
            return false;


        }
        return false;
    }

    public static function checkIfAnyRights($right): bool
    {
        // TODO REMOVE session()->has()
        if (Auth::user()) {
            $groupDetails = new GroupDetailModel();
            $groupDetailsTable = $groupDetails->getTable();
            $groupRights = new GroupRightsModel();
            $groupRightTable = $groupRights->getTable();
            $user = new User();
            $userTable = $user->getTable();
            $result = [];
            $count = count($right);
            for ($i = 0; $i < $count; $i++) {
                $result[] = $user->where("$userTable.id", Auth::user()->id)
                    ->LeftJoin("$groupDetailsTable", "$userTable.id", "$groupDetailsTable.userid")
                    ->join("$groupRightTable", "$groupDetailsTable.groupid", "$groupRightTable.id")
                    ->select("$groupRightTable.name", "$groupRightTable.$right[$i]", "$groupRightTable.isadmin");

                foreach ($result[$i]->get()->all() as $permission) {
                    if ($permission['isadmin'] == "GRANT") {
                        return true;
                    }
                }


                foreach ($result[$i]->get()->all() as $permission) {

                    if ($i == $count - 1) {
                        if ($permission[$right[$i]] == "GRANT") {
                            return true;
                        }
                    }
                    if ($permission[$right[$i]] == "GRANT") {
                        return true;
                    }

                }
            }
            return false;


        }
        return false;
    }

    public function checkIfAnyRight($right = ['isadmin']): bool
    {
        if (Auth::user()) {
            $userid = Auth::id();
            $groupDetails = new GroupDetailModel();
            $groupDetailsTable = $groupDetails->getTable();
            $groupRights = new GroupRightsModel();
            $groupRightTable = $groupRights->getTable();
            $user = new User();
            $userTable = $user->getTable();
            $result = [];
            $count = count($right);
            for ($i = 0; $i < $count; $i++) {
                $result[] = $user->where("$userTable.id", $userid)
                    ->LeftJoin("$groupDetailsTable", "$userTable.id", "$groupDetailsTable.userid")
                    ->join("$groupRightTable", "$groupDetailsTable.groupid", "$groupRightTable.id")
                    ->select("$groupRightTable.name", "$groupRightTable.$right[$i]", "$groupRightTable.isadmin");

                foreach ($result[$i]->get()->all() as $permission) {
                    if ($permission['isadmin'] == "GRANT") {
                        return true;
                    }
                }


                foreach ($result[$i]->get()->all() as $permission) {

                    if ($i == $count - 1) {
                        if ($permission[$right[$i]] == "GRANT") {
                            return true;
                        }
                    }
                    if ($permission[$right[$i]] == "GRANT") {
                        return true;
                    }

                }
            }
            return false;


        }
        return false;
    }

    public function checkIfAllRightsController($right = ['isadmin']): bool
    {
        $groupDetails = new GroupDetailModel();
        $groupDetailsTable = $groupDetails->getTable();
        $groupRights = new GroupRightsModel();
        $groupRightTable = $groupRights->getTable();
        $user = new User();
        $userTable = $user->getTable();
        $result = [];
        $count = count($right);
        for ($i = 0; $i < $count; $i++) {
            $result[] = $user->where("$userTable.id", Auth::user()->id)
                ->LeftJoin("$groupDetailsTable", "$userTable.id", "$groupDetailsTable.userid")
                ->join("$groupRightTable", "$groupDetailsTable.groupid", "$groupRightTable.id")
                ->select("$groupRightTable.name", "$groupRightTable.$right[$i]", "$groupRightTable.isadmin");

            foreach ($result[$i]->get()->all() as $permission) {
                if ($permission['isadmin'] == "GRANT") {
                    return true;
                }
            }

            $check = false;

            foreach ($result[$i]->get()->all() as $permission) {

                if ($i == $count - 1) {
                    if ($permission[$right[$i]] == "GRANT") {
                        return true;
                    }
                }
                if ($permission[$right[$i]] == "GRANT") {
                    $check = true;
                }

            }
            if (!$check) {
                return false;
            }
        }
        return false;
    }


    /**
     * Prüft ob die Gruppe spezifische Rechte hat
     * @param $group
     * @param $right
     * @return array|false
     */
    public function hasRight($group, $right)
    {
        $access = [];

        try {
            for ($i = 0; $i < count($group); $i++) {
                for ($a = 0; $a < count($right); $a++) {
                    $result[$i] = $this->where("$this->table.name", $group[$i])
                        ->select("$this->table.$right[$a]")->get();
                    $access[$i] = $result[0][$i][$right[$a]];
                }

            }
        } catch (\PDOException $e) {
            return false;
        }
        return $access;
    }

    /**
     * Prüft ob der Benutzer Gruppen hat und gibt diese als Array zurück
     * @param $userid
     * @return mixed
     * @throws Exception
     */

    /**
     * Gibt eine GruppenId zurück
     * @param string $group
     * @return mixed
     */
    public function getGroupId($group)
    {
        return $this->where("$this->table.name", "$group")
            ->select("$this->table.id")
            ->get();
    }

    /**
     * Holt sich alle Gruppen
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllGroups()
    {
        return $this->all();
    }

    /**
     * Sucht eine Gruppe
     * @param $value
     * @return false
     */
    public function findGroup($value)
    {
        $groups = $this->all();
        for ($i = 0; $i < count($groups); $i++) {
            $result = $this->where("$this->table.name", "like", "%$value%")->orWhere("$this->table.id", "like", "%$value%")->get();
        }
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
        return false;
    }

    /**
     * Holt sich eine Gruppe via GruppenID
     * @param $groupid
     * @return false|mixed
     */
    public function getGroup($groupid)
    {
        try {
            $result = $this->where("$this->table.id", $groupid)
                ->select("$this->table.*");

        } catch (\PDOException $e) {
            return false;
        }
        if (!empty($result->get()[0])) {
            return $result->get()[0];
        } else {
            return false;
        }
    }

    /**
     * Löscht eine Gruppe
     * @param $id
     * @return void
     */
    public function delGroup($id)
    {
        $this->where("$this->table.id", $id)->delete();
    }

    /**
     * Holt sich eine Gruppe via Gruppenname
     * @param $groupname
     * @return mixed|void
     */
    public function getGroupByGroupname($groupname)
    {
        $result = $this->where("$this->table.name", $groupname)
            ->select("$this->table.id", "$this->table.name");

        if (!empty($result->get()[0])) {
            return $result->get()[0];
        }
        return false;
    }

    /**
     * Prüft ob der Gruppenname exsitiert
     * @param $groupName
     * @return bool
     */
    public function checkIfExist($groupName)
    {
        $result = $this->where("$this->table.name", $groupName)
            ->select("$this->table.*");
        if (!empty($result->get()[0])) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Verknüpfung zu <b>GroupDetailModel::existGroup</b><br>
     * Prüft welche Gruppen der Benutzer noch nicht hat und gibt sie zurück
     * @param $groupArray
     * @return mixed
     */
    public function groupIsNotExist($groupArray)
    {
//        $result = $this->whereNotIn("$this->table.name", $groupArray)->get();
        return $this->whereNotIn("$this->table.name", $groupArray)
            ->select("$this->table.name as gruppe", "$this->table.id")->get();
    }

    public function getPermittedGroups($right)
    {
        $result = $this->where("$this->table.isadmin", "GRANT")->orWhere("$this->table.$right", "GRANT")
            ->select("name", "id")->get();
        return $result;
    }

}
