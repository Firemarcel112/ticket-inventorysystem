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
        Schema::table('groupdetails', function (Blueprint $table) {
            $table->foreign('userid')->references('id')->on('users');
            $table->foreign('groupid')->references('id')->on('grouprights');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groupdetails', function (Blueprint $table) {
            $table->dropConstrainedForeignId('userid');
            $table->dropConstrainedForeignId('groupid');
        });
    }
};
