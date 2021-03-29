<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAdminSettingsTableToAddContactFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_settings', function (Blueprint $table) {
            if(!Schema::hasColumn('admin_settings', 'contact_number')){
                $table->string('contact_number')->nullable();
            }

            if(!Schema::hasColumn('admin_settings', 'email')){
                $table->string('email')->nullable();
            }

            if(!Schema::hasColumn('admin_settings', 'address')){
                $table->text('address')->nullable();
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
            if(Schema::hasColumn('admin_settings', 'contact_number')){
                $table->dropColumn('contact_number');
            }

            if(Schema::hasColumn('admin_settings', 'email')){
                $table->dropColumn('email');
            }

            if(Schema::hasColumn('admin_settings', 'address')){
                $table->dropColumn('address');
            }
        });
    }
}
