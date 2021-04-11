<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('title');
            $table->string('authors');
            $table->string('supervisor');
            $table->string('sub_supervisor')->nullable();
            $table->text('abstract')->nullable();
            $table->text('conclusion')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->unsignedBigInteger('specialty_id');
            $table->unsignedBigInteger('stage_id');
            $table->smallInteger('row')->nullable();
            $table->smallInteger('col')->nullable();
            $table->smallInteger('rack')->nullable();
            $table->string('notes')->nullable();
            $table->string('file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();

            $table->foreign('specialty_id')->references('id')->on('specialties');
            $table->foreign('stage_id')->references('id')->on('stages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
