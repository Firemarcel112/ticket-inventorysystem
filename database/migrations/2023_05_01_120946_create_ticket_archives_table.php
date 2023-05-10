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
        Schema::create('ticket_archives', function (Blueprint $table) {
            $table->id();
            $table->text('headline');
            $table->bigInteger('ticket_id');
            $table->text('content');
            $table->text('username');
            $table->text('category');
            $table->text('assigned_to');
            $table->timestamp('archived_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_archives');
    }
};
