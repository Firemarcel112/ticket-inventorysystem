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
        Schema::table('license_rentals', function (Blueprint $table) {
            $table->foreign('asset_id')->references('id')->on('assets')->onUpdate('cascade');;;
            $table->foreign('license_id')->references('id')->on('licenses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('license_rentals', function (Blueprint $table) {
            $table->dropConstrainedForeignId('asset_id');
            $table->dropConstrainedForeignId('license_id');
        });
    }
};
