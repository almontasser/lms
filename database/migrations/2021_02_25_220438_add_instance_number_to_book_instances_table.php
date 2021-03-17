<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstanceNumberToBookInstancesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('book_instances', function (Blueprint $table) {
      $table->smallInteger('instance_number');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('book_instances', function (Blueprint $table) {
      $table->dropColumn('instance_number');
    });
  }
}
