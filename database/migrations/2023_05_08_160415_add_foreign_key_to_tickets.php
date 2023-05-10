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
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('ticket_categories');
            $table->foreign('status_id')->references('id')->on('ticket_statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assigner_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groupdetails');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('status_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('assigner_id');
            $table->dropConstrainedForeignId('group_id');
        });
    }
};
