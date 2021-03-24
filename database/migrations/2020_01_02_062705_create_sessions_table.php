<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('level')->nullable();
            $table->string('subject')->nullable();
            $table->integer('rate');
            $table->integer('hours');
            $table->integer('total');
            $table->boolean('seen')->default(0);
            $table->datetime('date')->nullable();
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
        Schema::dropIfExists('sessions');
    }
}
