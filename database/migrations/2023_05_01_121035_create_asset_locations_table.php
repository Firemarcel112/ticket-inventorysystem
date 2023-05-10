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
        Schema::create('asset_locations', function (Blueprint $table) {
            $table->id();
            $table->text('room')->nullable();
            $table->text('storageplace')->nullable();
            $table->text('street');
            $table->text('postalcode')->nullable();
            $table->timestamps();
        });
        DB::table("asset_locations")->insert([
            "street" => "unterwegs",
        ]);
        DB::table("asset_locations")->insert([
            "room" => "06",
            "street" => "Adolfstraße 10",
            "postalcode" => "30169",
        ]);
        DB::table("asset_locations")->insert([
            "room" => "IT-Büro",
            "street" => "Adolfstraße 10",
            "postalcode" => "30169",
        ]);
        DB::table("asset_locations")->insert([
            "room" => "B24",
            "street" => "Baumstraße 18-20",
            "postalcode" => "30171",
        ]);
        DB::table("asset_locations")->insert([
            "room" => "22",
            "storageplace" => "Schrank 2",
            "street" => "Adolfstraße 10",
            "postalcode" => "30169",
        ]);
        DB::table("asset_locations")->insert([
            "room" => "Lager",
            "storageplace" => "Schrank 1",
            "street" => "Adolfstraße 10",
            "postalcode" => "30169",
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_locations');
    }
};
