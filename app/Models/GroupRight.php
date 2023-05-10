<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'isAdmin',

        'ticketaccess',
        'modifyticket',
        'openticket',
        'closeticket',
        'readticket',
        'sendticketmessage',

        'createticketcategories',
        'modifyticketcategories',
        'deleteticketcategories',

        'createticketstatus',
        'modifyticketstatus',
        'deleteticketstatus',

        'archiveaccess',
        'deletearchive',

        'fullaccess',
        'dashboardaccess',

        'assetaccess',
        'modifyasset',
        'deleteasset',
        'createasset',

        'modelaccess',
        'modifymodel',
        'deletemodel',
        'createmodel',

        'manufactureraccess',
        'modifymanufacturer',
        'deletemanufacturer',
        'createmanufacturer',

        'categoriesaccess',
        'modifycategories',
        'deletecategories',
        'createcategories',

        'locationaccess',
        'modifylocation',
        'deletelocation',
        'createlocation',

        'statusaccess',
        'modifystatus',
        'deletestatus',
        'createstatus',

        'departmentaccess',
        'modifydepartment',
        'deletedepartment',
        'createdepartment',

        'accesslicense',
        'modifylicense',
        'deletelicense',
        'createlicense',

        'managefaq'
    ];

    public function groupDetail() {
        return $this->belongsTo(GroupDetail::class);
    }

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}
