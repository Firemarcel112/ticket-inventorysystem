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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('licensekey');
            $table->bigInteger('manufacturer_id')->unsigned();
            $table->integer('total')->default(1);
            $table->date('expirationdate');
            $table->date('purchasedate')->nullable();
            $table->decimal('purchasecost')->nullable();
            $table->text('purchaselink')->nullable();
            $table->text('ordernumber')->nullable();
            $table->decimal('monthprice')->nullable();
            $table->integer('duration')->nullable();
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
        Schema::dropIfExists('licenses');
    }
};
