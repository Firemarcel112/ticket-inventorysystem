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
        Schema::create('contact_partners', function (Blueprint $table) {
            $table->id();
            $table->text('firstname');
            $table->text('lastname');
            $table->text('imagepath');
            $table->boolean('visiblefrontpage')->default(false);
            $table->timestamps();
        });

        DB::table("contact_partners")->insert([
            "id" => 1,
            "firstname" => "Sven",
            "lastname" => "Burhenne",
            'visiblefrontpage' => 1,
            "imagepath" => "secure_dnt/defaultmen.jpg",
        ]);
        DB::table("contact_partners")->insert([
            "id" => 2,
            "firstname" => "Marcel",
            "lastname" => "Storck",
            'visiblefrontpage' => 1,
            "imagepath" => "secure_dnt/defaultmen2.jpg",
        ]);
        DB::table("contact_partners")->insert([
            "id" => 3,
            "firstname" => "Sabine",
            "lastname" => "Buss",
            'visiblefrontpage' => 1,
            "imagepath" => "secure_dnt/defaultwomen.jpg",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_partners');
    }
};
