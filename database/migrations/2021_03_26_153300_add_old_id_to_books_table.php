<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldIdToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('old_NS')->nullable();
            $table->string('old_NO')->nullable();
            $table->string('old_CLA')->nullable();
            $table->string('old_SUB')->nullable();
            $table->string('old_CLA1')->nullable();
            $table->string('old_TYPE')->nullable();
            $table->boolean('reviewed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
          $table->dropColumn('old_NS');
          $table->dropColumn('old_NO');
          $table->dropColumn('old_CLA');
          $table->dropColumn('old_SUB');
          $table->dropColumn('old_CLA1');
          $table->dropColumn('old_TYPE');
          $table->dropColumn('reviewed');
        });
    }
}
