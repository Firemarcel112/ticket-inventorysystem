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
        Schema::table('ticket_archive_messages', function (Blueprint $table) {
            $table->foreign('ticket_id')->references('id')->on('ticket_archives');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_archive_messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('ticket_id');

        });
    }
};
