<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('exams', function (Blueprint $table) {
          $table->increments('id');
          $table->json('questions');
          $table->text('title');
          $table->integer('minutes')->default(0);
          $table->integer('stage_id');
          $table->integer('points')->default(0);
          $table->boolean('published')->default(false);
          $table->boolean('heading')->default(false);
          $table->integer('monthly')->default(0);
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
      Schema::dropIfExists('exams');

    }
}
