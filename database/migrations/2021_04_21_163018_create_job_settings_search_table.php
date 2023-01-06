<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSettingsSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_settings_search', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('job_titles');
            $table->string('skills');
            $table->string('preferred_employees');
            $table->string('excluded_employees');
            $table->integer('willingToTravel');
            $table->boolean('distOfMe');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_settings_search');
    }
}
