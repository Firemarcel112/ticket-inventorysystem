<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_images', function (Blueprint $table) {
            $table->id();
            $table->text('imagepath')->nullable();
            $table->text('imagedescription')->nullable();
            $table->bigInteger('faq_id')->unsigned();
            $table->timestamps();
        });

        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/bluescreen1.png',
            'imagedescription' => 'Windows Taste + R um das Ausführen Fenster zu öffnen.',
            'faq_id' => 3,
        ]);
        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/bluescreen2.png',
            'imagedescription' => 'Abgesicherten Modus starten',
            'faq_id' => 3,
        ]);
        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/schulcloudFAQ1.png',
            'imagedescription' => 'Schritt 1',
            'faq_id' => 1,
        ]);
        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/schulcloudFAQ2.png',
            'imagedescription' => 'Schritt 2',
            'faq_id' => 1,
        ]);
        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/webuntisFAQ1.png',
            'imagedescription' => 'Login, sobald die Schule ausgewählt wurde',
            'faq_id' => 4,
        ]);
        DB::table('faq_images')->insert([
            'imagepath' => 'secure_dnt/webuntisFAQ2.png',
            'imagedescription' => 'Angaben zur Zurücksetzung des Passwortes',
            'faq_id' => 4,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_images');
    }
};
