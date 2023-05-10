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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->text('customname')->nullable();
            $table->text('serialnumber')->nullable();
            $table->text('macaddress')->nullable();

            $table->date('purchasedate')->nullable();
            $table->decimal('purchasecost')->nullable();
            $table->text('purchaselink')->nullable();

            $table->decimal('monthprice')->nullable();
            $table->integer('duration')->nullable();

            $table->text('ordernumber')->nullable();

            $table->date('warranty')->nullable();
            $table->bigInteger('model_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
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
        Schema::dropIfExists('assets');
    }
};
