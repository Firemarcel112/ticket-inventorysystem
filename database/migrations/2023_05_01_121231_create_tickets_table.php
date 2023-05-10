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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->text('headline');
            $table->text('content');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('assigner_id')->unsigned();
            $table->bigInteger('group_id')->unsigned();
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
        Schema::dropIfExists('tickets');
    }
};
