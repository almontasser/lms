<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToResearchPapersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('research_papers', function (Blueprint $table) {
      $table->string('orcid')->nullable()->unique();
      $table->string('author_email')->nullable()->unique();
      $table->string('language')->nullable();
      $table->string('country')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('research_papers', function (Blueprint $table) {
      $table->dropColumn('orcid');
      $table->dropColumn('author_email');
      $table->dropColumn('language');
      $table->dropColumn('country');
    });
  }
}
