<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->string('secondary_phone')->nullable()->default(null);
            $table->string('emergency_name')->nullable()->default(null);
            $table->string('emergency_phone')->nullable()->default(null);
            $table->string('emergency_relationship')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropColumn('secondary_phone');
            $table->dropColumn('emergency_name');
            $table->dropColumn('emergency_phone');
            $table->dropColumn('emergency_relationship');
        });
    }
}
