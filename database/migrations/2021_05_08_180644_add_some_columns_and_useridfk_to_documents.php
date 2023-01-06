<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnsAndUseridfkToDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'is_primary')) {
                $table->integer('is_primary')->after('user_id')->default(0);
            }

            if (!Schema::hasColumn('documents', 'original_filename')) {
                $table->string('original_filename')->after('filename');
            }

            if (Schema::hasColumn('documents', 'user_id')) {
                $table->unsignedBigInteger('user_id')->change();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
            $table->dropForeign(['user_id']);

            if (Schema::hasColumn('documents', 'original_filename')) {
                $table->dropColumn('original_filename');
            }

            if (Schema::hasColumn('documents', 'is_primary')) {
                $table->dropColumn('is_primary');
            }
        });
    }
}
