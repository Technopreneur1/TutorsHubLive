<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('users', 'transit_number')){
            Schema::table('users', function (Blueprint $table) {
                $table->text('transit_number')->nullable()->after('routing_number');
            });
        }

        if(!Schema::hasColumn('users', 'institution_number')){
            Schema::table('users', function (Blueprint $table) {
                $table->text('institution_number')->nullable()->after('transit_number');
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
        if(Schema::hasColumn('users', 'transit_number')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('transit_number');
            });
        }

        if(Schema::hasColumn('users', 'institution_number')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('institution_number');
            });
        }
    }
}
