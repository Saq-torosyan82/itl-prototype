<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_vacancies', function(Blueprint $table){
            $table->dropColumn(['employer', 'description', 'pay']);
            $table->bigInteger('client_id');
            $table->longText('job_description')->nullable();
            $table->longText('job_requirements')->nullable();
            $table->string('pay_range');
            $table->string('location');
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
