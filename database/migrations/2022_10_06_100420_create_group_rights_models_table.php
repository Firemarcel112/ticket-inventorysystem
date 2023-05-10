<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grouprights', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("isadmin", 5)->default("DENY");
            // Ticket //
            $table->string("ticketaccess", 5)->default("DENY");
            $table->string("modifyticket", 5)->default("DENY");
            $table->string("openticket", 5)->default("DENY");
            $table->string("closeticket", 5)->default("DENY");
            $table->string("readticket", 5)->default("DENY");
            $table->string("sendticketmessage", 5)->default("DENY");
            // Ticket Categories //
            $table->string("createticketcategories", 5)->default("DENY");
            $table->string("modifyticketcategories", 5)->default("DENY");
            $table->string("deleteticketcategories", 5)->default("DENY");
            // Ticket Status //
            $table->string("createticketstatus", 5)->default("DENY");
            $table->string("modifyticketstatus", 5)->default("DENY");
            $table->string("deleteticketstatus", 5)->default("DENY");
            // Archive //
            $table->string("archiveaccess", 5)->default("DENY");
            $table->string("deletearchive", 5)->default("DENY");
            // IVE //
            $table->string("fullaccess", 5)->default("DENY");
            $table->string("dashboardaccess", 5)->default("DENY");
            // Assets //
            $table->string('assetaccess', 5)->default("DENY");
            $table->string('modifyasset', 5)->default("DENY");
            $table->string('deleteasset', 5)->default("DENY");
            $table->string('createasset', 5)->default("DENY");
            // Model //
            $table->string('modelaccess', 5)->default("DENY");
            $table->string('modifymodel', 5)->default("DENY");
            $table->string('deletemodel', 5)->default("DENY");
            $table->string('createmodel', 5)->default("DENY");
            // Manufacturer //
            $table->string('manufactureraccess', 5)->default("DENY");
            $table->string('modifymanufacturer', 5)->default("DENY");
            $table->string('deletemanufacturer', 5)->default("DENY");
            $table->string('createmanufacturer', 5)->default("DENY");
            // Categories //
            $table->string('categoriesaccess', 5)->default("DENY");
            $table->string('modifycategories', 5)->default("DENY");
            $table->string('deletecategories', 5)->default("DENY");
            $table->string('createcategories', 5)->default("DENY");
            // Location //
            $table->string("locationaccess", 5)->default("DENY");
            $table->string("modifylocation", 5)->default("DENY");
            $table->string("deletelocation", 5)->default("DENY");
            $table->string("createlocation", 5)->default("DENY");
            // Status //
            $table->string('statusaccess', 5)->default("DENY");
            $table->string('modifystatus', 5)->default("DENY");
            $table->string('deletestatus', 5)->default("DENY");
            $table->string('createstatus', 5)->default("DENY");
            // Department //
            $table->string('departmentaccess', 5)->default("DENY");
            $table->string('modifydepartment', 5)->default("DENY");
            $table->string('deletedepartment', 5)->default("DENY");
            $table->string('createdepartment', 5)->default("DENY");
            // License //
            $table->string('accesslicense', 5)->default("DENY");
            $table->string('modifylicense', 5)->default("DENY");
            $table->string('deletelicense', 5)->default("DENY");
            $table->string('createlicense', 5)->default("DENY");

            $table->string("managefaq", 5)->default("DENY");
            $table->timestamps();
        });

        DB::table("grouprights")->insert([
            "id" => 1,
            "name" => "Administrator",
            "isadmin" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 2,
            "name" => "Benutzer",
            "openticket" => "GRANT",
            "closeticket" => "GRANT",
            "sendticketmessage" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 3,
            "name" => "CTA",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 4,
            "name" => "BTA",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 5,
            "name" => "UTA",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 6,
            "name" => "ITA",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 7,
            "name" => "PTA",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 8,
            "name" => "TEM",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 9,
            "name" => "SEM",
            "assetaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 10,
            "name" => "WTM",
            "assetaccess" => "GRANT",
        ]);

        DB::table('grouprights')->insert([
            'id' => 11,
            'name' => 'Ticket',
            'ticketaccess' => 'GRANT',
            'modifyticket' => 'GRANT',
            'openticket' => 'GRANT',
            'closeticket' => 'GRANT',
            'readticket' => 'GRANT',
            'sendticketmessage' => 'GRANT',
            'createticketcategories' => 'GRANT',
            'modifyticketcategories' => 'GRANT',
            'deleteticketcategories' => 'GRANT',
            'createticketstatus' => 'GRANT',
            'modifyticketstatus' => 'GRANT',
            'deleteticketstatus' => 'GRANT',
            'archiveaccess' => 'GRANT',
            'deletearchive' => 'GRANT',
        ]);

        DB::table("grouprights")->insert([
            "id" => 12,
            "name" => "InventarAdmin",
            "fullaccess" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 13,
            "name" => "faq",
            "managefaq" => "GRANT",
        ]);

        DB::table("grouprights")->insert([
            "id" => 14,
            "name" => "Inventar",
            'assetaccess' => 'GRANT',
            'modifyasset' => 'GRANT',
            'createasset' => 'GRANT',
            'modelaccess' => 'GRANT',
            'modifymodel' => 'GRANT',
            'createmodel' => 'GRANT',
            'manufactureraccess' => 'GRANT',
            'modifymanufacturer' => 'GRANT',
            'createmanufacturer' => 'GRANT',
            'categoriesaccess' => 'GRANT',
            'modifycategories' => 'GRANT',
            'createcategories' => 'GRANT',
            "locationaccess" => 'GRANT',
            "modifylocation" => 'GRANT',
            "createlocation" => 'GRANT',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grouprights');
    }
};
