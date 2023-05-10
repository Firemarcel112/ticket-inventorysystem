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

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('shortcontent');
            $table->text('longcontent');
            $table->bigInteger('faq_category_id')->unsigned();
            $table->boolean('visiblefrontpage')->default(false);
            $table->timestamps();
        });
        DB::table("faqs")->insert([
            "title" => "Schulcloud Passwort vergessen",
            "shortcontent" => "Klicken Sie bei Schulcloud auf Passwort vergessen",
            "longcontent" => "Schritt 1: Klicken Sie beim Anmelden auf Accountpasswort vergessen
                              Schritt 2: Geben Sie Ihre Email an
                              Schritt 3: Folgen Sie den Anweisungen, die Sie von der Email erhalten",
            "faq_category_id" => "1",
            "visiblefrontpage" => "1",
        ]);
        DB::table("faqs")->insert([
            "title" => "Xampp funktioniert nicht",
            "shortcontent" => "Installieren Sie Xampp neu",
            "longcontent" => "Deinstallieren Sie Xampp und installieren Sie es anschließend neu!",
            "faq_category_id" => "2",
            "visiblefrontpage" => "1",
        ]);
        DB::table("faqs")->insert([
            "title" => "Laptop zeigt Bluescreen",
            "shortcontent" => "Der Bluescreen erscheint als Folge eines kritischen Systemfehlers. Ursache kann fehlerhafte Software oder Hardware sein – zum Beispiel ein defekter Treiber, das Update eines Programms oder ein Lesefehler auf der Festplatte",
            "longcontent" => "Wenn mehrere Bluescreens verhindern, dass Sie ungestört Einstellungen vornehmen und Lösungswege angehen können, empfiehlt es sich, Windows zunächst im abgesicherten Modus zu starten.
            Halten Sie die Taste F8 beim Hochfahren des PCs gedrückt, um noch vor dem Erscheinen des Windows-Logos in den abgesicherten Modus zu wechseln.
            In diesem Modus lädt Windows nur die absolut notwendigen Prozesse und Treiber. U. U. lassen sich damit vorhandene Probleme beheben, ohne einen Bluescreen zu bekommen.
            Eine andere Methode, den abgesicherten Modus einzuschalten, funktioniert direkt in Windows. Suchen Sie nach der Funktion „msconfig“ im Startmenü und führen Sie diese per Rechtsklick als Administrator aus.",
            "faq_category_id" => "3",
            "visiblefrontpage" => "1",
        ]);
        DB::table("faqs")->insert([
            "title" => "Webuntis Login Probleme",
            "shortcontent" => "Klicken Sie auf Passwort vergessen",
            "longcontent" => "Wählen Sie als Schule Sabine Blindow Schule aus.
            Ihr Benutzername ist Ihr Nachname und dann die ersten drei Buchstaben von ihrem Vornamen. Nachname und Vorname werden zusammen und kleingeschrieben. Dann geben Sie Ihr Passwort ein.
            Falls Sie ihr Passwort vergessen habt, können Sie auf Passwort vergessen klicken und ihnen werden weitere Anweisungen per Email zugeschickt.",
            "faq_category_id" => "1",
            "visiblefrontpage" => "1",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
