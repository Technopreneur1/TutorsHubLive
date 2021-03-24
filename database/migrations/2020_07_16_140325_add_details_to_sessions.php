<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToSessions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->string('sessiontype');
            $table->string('endsession')->nullable();
            $table->string('startsession')->nullable();
            $table->string('accept')->nullable();
            $table->string('roomname')->nullable();
            $table->integer('payment_status')->default(0);
            $table->integer('class_status')->default(0);
            $table->string('agora_session')->nullable();
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
            Schema::dropIfExists('sessiontype');
            Schema::dropIfExists('endsession');
            Schema::dropIfExists('startsession');
            Schema::dropIfExists('accept');
            Schema::dropIfExists('roomname');
            Schema::dropIfExists('payment_status');
            Schema::dropIfExists('class_status');
            Schema::dropIfExists('agora_session');
        });
    }
}
