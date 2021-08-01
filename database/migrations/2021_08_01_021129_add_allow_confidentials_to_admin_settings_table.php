<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllowConfidentialsToAdminSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('admin_settings', 'allow_confidentials')){
                $table->boolean('allow_confidentials_in_messages')->default(0);
                $table->boolean('allow_confidentials_in_bio')->default(0);
                $table->boolean('allow_confidentials_in_ads')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            if (Schema::hasColumn('admin_settings', 'allow_confidentials')){
                $table->dropColumn('allow_confidentials_in_messages');
                $table->dropColumn('allow_confidentials_in_bio');
                $table->dropColumn('allow_confidentials_in_ads');
            }
        });
    }
}
