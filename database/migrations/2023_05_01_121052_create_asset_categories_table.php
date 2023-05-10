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
        Schema::create('asset_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unigue();
            $table->timestamps();
        });
        DB::table("asset_categories")->insert([
            "name" => "Laptop"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Desktop"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Bildschirm"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "E-Tafel"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Handy"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Tablet"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Messzylinder"
        ]);
        DB::table("asset_categories")->insert([
            "name" => "Peripherie"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_categories');
    }
};
