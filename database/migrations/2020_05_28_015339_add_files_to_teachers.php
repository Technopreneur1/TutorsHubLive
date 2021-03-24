<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesToTeachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('resume')->nullable();
            $table->string('background_check')->nullable();
            $table->string('identity')->nullable();
            $table->string('medium')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            Schema::dropIfExists('resume');
            Schema::dropIfExists('background_check');
            Schema::dropIfExists('identity');
            Schema::dropIfExists('medium');
        });
    }
}
