<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupDetailModel extends Model
{
    use HasFactory;

    protected $table = "groupdetails";

    protected $fillable = [
        "userid",
        "groupid"
    ];

    /**
     * Prüft welche Gruppen existieren und gibt fehlende Gruppen zurück<br>
     * <b>Work in Progress</b>
     * @param $userid
     */

    public function user() {
        return $this->belongsTo(User::class, 'userid');
    }

    public function group() {
        return $this->belongsTo(GroupRightsModel::class, 'groupid');
    }

    public function existGroup($userid)  {

        $groupRights = new GroupRightsModel();
        $joinTable = $groupRights->getTable();
        $hasGroups = $this->select("$joinTable.name")->distinct()->join($joinTable, "$this->table.groupid", "$joinTable.id")
            ->where("$this->table.userid", $userid)->get();
        $groups = [];
        for($i = 0; $i < count($hasGroups); $i++) {
            $groups[] = $hasGroups[$i]['name'];
        }

        $res = $groupRights->groupIsNotExist($groups);

        $result = [];
        for($i = 0; $i < count($res); $i++) {
            $result[$i] = $res[$i];
        }

        return $result;
    }


    public function getGroup($userid) {

        $groupRights = new GroupRightsModel();
        $joinTable = $groupRights->getTable();
        $result = [];

        $group = $this->where("$this->table.userid", "$userid")
            ->join("$joinTable", "$this->table.groupid", "$joinTable.id")
            ->select("$joinTable.id", "$joinTable.name as gruppe")->get();

        for($i = 0; $i < count($group); $i++) {
            $result[$i] = $group[$i];
        }
        return $result;
    }

    public function addGroup($groupid, $userid) {
        $isGroupAlreadyExist = $this->select('*')->where('userid', $userid)->where('groupid', $groupid)->get();
        if(empty($isGroupAlreadyExist[0]["groupid"])) {
            $this->whereNotIn('groupid', [$groupid])->insert([
                'groupid' => $groupid,
                'userid' => $userid,
                'created_at' => now('Europe/Berlin'),
                'updated_at' => now('Europe/Berlin'),
            ]);
        }
    }

    public  function remGroup($groupid, $userid) {
        $group = $groupid[0]["id"];
        $this->where('groupid', $group)->where('userid', $userid)->delete();
    }

    public function remGroupByUserID($userid, $group) {
        $this->where('userid', $userid)->where('groupid', $group)->delete();
    }

    public function remGroupsFromUser($userid) {
        $this->where('userid', $userid)->delete();

    }

    public function remGroupByGroupID($groupid) {
        $this->where('groupid', $groupid)->delete();
    }
}
