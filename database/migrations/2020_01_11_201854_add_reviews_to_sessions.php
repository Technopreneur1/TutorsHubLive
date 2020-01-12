<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReviewsToSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->boolean('completed')->default(0)->nullable(); // By Student
            $table->integer('tutor_rating')->nullable(); // By Student
            $table->integer('student_rating')->nullable(); // By Tutor
            $table->text('tutor_review')->nullable(); // By Student
            $table->text('student_review')->nullable(); // By Tutor
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            Schema::dropIfExists('paypal');
        });
    }
}
