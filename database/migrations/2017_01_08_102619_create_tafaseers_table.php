<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTafaseersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tafaseers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ayaat_id')->unsigned();
            $table->integer('mofaseer_id')->unsigned();
            $table->timestamps();

            $table->foreign('ayaat_id')->references('id')->on('ayaats');
            $table->foreign('mofaseer_id')->references('id')->on('mofaseers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tafaseers');
    }
}
