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
        Schema::create('asset_manufacturers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('website')->nullable();
            $table->text('postalcode')->nullable();
            $table->text('email')->nullable();
            $table->text('street')->nullable();
            $table->timestamps();
        });
        DB::table("asset_manufacturers")->insert([
            "name" => "Microsoft",
            "website" => 'https://support.microsoft.com/de-DE',
        ]);

        DB::table("asset_manufacturers")->insert([
            "name" => "Office",
            "website" => 'https://www.office.com/',
        ]);

        DB::table("asset_manufacturers")->insert([
            "name" => "Lenovo",
            "website" => 'https://www.lenovo.com/de/de/contact/',
        ]);

        DB::table("asset_manufacturers")->insert([
            "name" => "HP",
            "website" => 'https://support.hp.com/de-de',
        ]);

        DB::table("asset_manufacturers")->insert([
            "name" => "DELL",
            "website" => 'https://www.dell.com/support/home/de-de',
        ]);

        DB::table("asset_manufacturers")->insert([
            "name" => "Legamaster",
            "website" => 'https://www.legamaster.com/de/home/kontakt',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_manufacturers');
    }
};
