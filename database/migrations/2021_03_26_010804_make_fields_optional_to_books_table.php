<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldsOptionalToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
          $table->string('author')->nullable()->change();
          $table->string('publisher')->nullable()->change();
          $table->string('subject')->nullable()->change();
          $table->unsignedBigInteger('field_id')->nullable()->change();
          $table->unsignedBigInteger('specialty_id')->nullable()->change();
          $table->string('print_year')->nullable()->change();
          $table->smallInteger('edition')->nullable()->change();
          $table->string('ISBN')->nullable()->change();
          $table->string('category')->nullable()->change();
          $table->text('description')->nullable()->change();
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
          $table->string('author')->change();
          $table->string('publisher')->change();
          $table->string('subject')->change();
          $table->unsignedBigInteger('field_id')->change();
          $table->unsignedBigInteger('specialty_id')->change();
          $table->string('print_year')->change();
          $table->smallInteger('edition')->change();
          $table->string('ISBN')->change();
          $table->string('category')->change();
          $table->text('description')->change();
        });
    }
}
