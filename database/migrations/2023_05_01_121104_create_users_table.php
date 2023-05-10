<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->text('email');
            $table->text('password');
            $table->timestamps();
        });

        DB::table('users')->insert([
            'username' => 'Administrator',
            'email' => 'admin@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'Lager',
            'email' => 'lager@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'Ticket',
            'email' => 'ticket@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'Inventar',
            'email' => 'inventar@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'Faq',
            'email' => 'faq@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'CTA-Inventar',
            'email' => 'cta@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'Schüler',
            'email' => 'schüler@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
        DB::table('users')->insert([
            'username' => 'CTA-Schüler',
            'email' => 'cta@it-assistant.de',
            'password' => Hash::make('I821123'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
