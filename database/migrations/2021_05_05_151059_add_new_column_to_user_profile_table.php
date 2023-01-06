<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->integer('certificate')->default(0);
            $table->string('secondary_address')->nullable()->default(null);

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
            $table->dropColumn('certificate');
            $table->dropColumn('secondary_address');
        });
    }
}
