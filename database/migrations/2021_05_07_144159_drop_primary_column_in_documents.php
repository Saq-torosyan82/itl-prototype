<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPrimaryColumnInDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (Schema::hasColumn('documents', 'primary')) {
                $table->dropColumn('primary');
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
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'primary')) {
                $table->integer('primary')->default(0);
            }
        });
    }
}
