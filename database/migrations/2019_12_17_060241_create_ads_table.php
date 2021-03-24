<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->nullable()->unsigned();
            $table->integer('city_id')->nullable()->unsigned();
            $table->integer('neighborhood_id')->nullable()->unsigned();
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->integer('discipline_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->string('title');
            $table->text('description');
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
        Schema::dropIfExists('ads');
    }
}
