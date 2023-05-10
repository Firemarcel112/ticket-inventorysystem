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
        Schema::create('faq_categories', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('imagepath');
            $table->timestamps();
        });

        DB::table("faq_categories")->insert([
            "name" => "Account Probleme",
            "imagepath" => '/secure_dnt/faq_accountproblems.png'
        ]);

        DB::table("faq_categories")->insert([
            "name" => "Software Probleme",
            "imagepath" => '/secure_dnt/faq_softwareproblems.png'
        ]);

        DB::table("faq_categories")->insert([
            "name" => "Computer Probleme",
            "imagepath" => '/secure_dnt/faq_computerproblems.png'
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_categories');
    }
};
