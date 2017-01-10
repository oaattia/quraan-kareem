<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAyaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ayaats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('soraah_id')->unsigned();
            $table->longText('text');
            $table->integer('number');
            $table->timestamps();

            $table->foreign('soraah_id')->references('id')->on('soraahs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayaats');
    }
}
