<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Eloquent\Faker;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_models', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('website')->nullable();
            $table->timestamps();
        });
        DB::table("asset_models")->insert([
            "name" => "custom",
        ]);
        DB::table("asset_models")->insert([
            "name" => "Thinkpad E15 gen2",
        ]);
        DB::table("asset_models")->insert([
            "name" => "Macbook Pro",
        ]);
        DB::table("asset_models")->insert([
            "name" => "Surface Pro 9",
        ]);
        DB::table("asset_models")->insert([
            "name" => "Galaxy S20",
        ]);
        DB::table("asset_models")->insert([
            "name" => "iPhone 14 Pro",
        ]);
        DB::table("asset_models")->insert([
            "name" => "EH-TW7000 Beamer",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_models');
    }
};
