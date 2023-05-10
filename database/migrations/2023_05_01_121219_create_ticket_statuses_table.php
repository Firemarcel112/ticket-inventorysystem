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
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('color');
            $table->timestamps();
        });

        DB::table("ticket_statuses")->insert([
            "name" => "Neu",
            "color" => "#3cc232",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table("ticket_statuses")->insert([
            "name" => "Bearbeitung",
            "color" => "#D6CB25",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table("ticket_statuses")->insert([
            "name" => "Geschlossen",
            "color" => "#d92a1e",
            "created_at" => now("Europe/Berlin"),
            "updated_at" => now("Europe/Berlin"),
        ]);
        DB::table("ticket_statuses")->insert([
            "name" => "Archiviert",
            "color" => "#E5BD6C",
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
        Schema::dropIfExists('ticket_statuses');
    }
};
