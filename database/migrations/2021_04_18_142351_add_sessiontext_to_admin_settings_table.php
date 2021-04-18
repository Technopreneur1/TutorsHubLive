<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessiontextToAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('admin_settings', 'session_text')){
            Schema::table('admin_settings', function (Blueprint $table){
               $table->text('session_text')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            if (Schema::hasColumn('admin_settings', 'session_text')) {
                $table->dropColumn('session_text');
            }
        });
    }
}
