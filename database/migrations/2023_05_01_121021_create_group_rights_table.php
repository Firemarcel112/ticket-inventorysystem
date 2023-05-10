<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        goto skip;
        Schema::create('group_rights', function (Blueprint $table) {
            $table->id();
            $table->text("name")->unique();

            $rights = [
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

            foreach($rights as $right) {
                $table->string($right, 5)->default('DENY');
            }

            $table->timestamps();
        });
        skip:
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_rights');
    }
};
