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
        Schema::create('asset_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('color');
            $table->timestamps();
        });
        DB::table("asset_departments")->insert([
            "name" => "CTA",
            "color" => "#38A5AE",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "BTA",
            "color" => "#94c618",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "UTA",
            "color" => "#319c30",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "ITA",
            "color" => "#0073b5",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "PTA",
            "color" => "#e73121",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "TEM",
            "color" => "#f07b00",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "SEM",
            "color" => "#ffbd00",
        ]);
        DB::table("asset_departments")->insert([
            "name" => "WTM",
            "color" => "#ad1073",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_departments');
    }
};
