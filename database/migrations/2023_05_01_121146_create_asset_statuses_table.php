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
        Schema::create('asset_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('color');
            $table->timestamps();
        });
        DB::table("asset_statuses")->insert([
            "name" => "in Verwendung",
            "color" => "#3cc232",
        ]);
        DB::table("asset_statuses")->insert([
            "name" => "auf Lager",
            "color" => "#004080",
        ]);
        DB::table("asset_statuses")->insert([
            "name" => "wird Repariert",
            "color" => "#db8d40",
        ]);
        DB::table("asset_statuses")->insert([
            "name" => "Kaputt",
            "color" => "#d92a1e",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_statuses');
    }
};
