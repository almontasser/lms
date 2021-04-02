<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchPapersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('research_papers', function (Blueprint $table) {
      $table->id();
      $table->string('barcode')->unique();
      $table->string('title');
      $table->string('author')->nullable();
      $table->string('abstract')->nullable();
      $table->string('year', 10)->nullable();
      $table->smallInteger('row')->nullable();
      $table->smallInteger('col')->nullable();
      $table->smallInteger('rack')->nullable();
      $table->string('notes')->nullable();
      $table->string('file')->nullable();
      $table->string('thumbnail')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('research_papers');
  }
}
