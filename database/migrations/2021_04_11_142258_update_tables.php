<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Add columns to user_profile
        Schema::table('user_profile', function(Blueprint $table){
            $table->string('pps')->after('phone')->default("");
            $table->integer('seeking_employment')->after('pps')->default(0);
            $table->integer('own_transport')->after('seeking_employment')->default(0);
            $table->string('driving_license')->after('own_transport')->default("Standard");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
