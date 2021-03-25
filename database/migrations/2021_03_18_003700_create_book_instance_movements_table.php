<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInstanceMovementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_instance_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_instance_id');
            $table->unsignedBigInteger('user_id');
            $table->date('borrow_start');
            $table->date('borrow_end');
            $table->date('borrow_returned')->nullable();
            $table->timestamps();

            $table->foreign('book_instance_id')->references('id')->on('book_instances');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_instance_movements');
    }
}
