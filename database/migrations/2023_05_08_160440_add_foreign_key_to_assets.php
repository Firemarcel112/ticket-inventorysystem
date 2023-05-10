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
        Schema::table('assets', function (Blueprint $table) {
            $table->foreign('model_id')->references('id')->on('asset_models');
            $table->foreign('category_id')->references('id')->on('asset_categories');
            $table->foreign('status_id')->references('id')->on('asset_statuses');
            $table->foreign('manufacturer_id')->references('id')->on('asset_manufacturers');
            $table->foreign('location_id')->references('id')->on('asset_locations');
            $table->foreign('department_id')->references('id')->on('asset_departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('model_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropConstrainedForeignId('status_id');
            $table->dropConstrainedForeignId('manufacturer_id');
            $table->dropConstrainedForeignId('location_id');
            $table->dropConstrainedForeignId('department_id');
        });
    }
};
