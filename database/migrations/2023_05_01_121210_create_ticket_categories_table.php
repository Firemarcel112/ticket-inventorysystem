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
        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table("ticket_categories")->insert([
            "name" => "Account Probleme",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table('ticket_categories')->insert([
            "name" => "Stundenplan Probleme",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table('ticket_categories')->insert([
            "name" => "Google Classroom Probleme",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table("ticket_categories")->insert([
            "name" => "Frage bzgl. Fehltagen",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_categories');
    }
};
