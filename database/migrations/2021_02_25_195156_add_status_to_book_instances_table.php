<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToBookInstancesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('book_instances', function (Blueprint $table) {
      $table->enum('status', ['available', 'loaned', 'damaged', 'missing']);
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
      $table->dropColumn('status');
    });
  }
}
