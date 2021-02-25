<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('books', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('author');
      $table->string('publisher');
      $table->string('subject');
      $table->unsignedBigInteger('field_id');
      $table->unsignedBigInteger('specialty_id');
      $table->string('file')->nullable();
      $table->string('thumbnail')->nullable();
      $table->string('print_year');
      $table->smallInteger('edition');
      $table->string('ISBN');
      $table->string('category');
      $table->float('price')->nullable();
      $table->smallInteger('row')->nullable();
      $table->smallInteger('col')->nullable();
      $table->smallInteger('rack')->nullable();
      $table->string('notes')->nullable();
      $table->string('QR');
      $table->timestamps();

      $table->foreign('field_id')->references('id')->on('fields');
      $table->foreign('specialty_id')->references('id')->on('specialties');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('books');
  }
}
