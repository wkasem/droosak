<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcomes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title_arabic')->nullable();
            $table->text('title_english')->nullable();
            $table->text('subtitle_arabic')->nullable();
            $table->text('subtitle_english')->nullable();
            $table->text('about_arabic')->nullable();
            $table->text('about_english')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('email')->nullable();
            $table->text('map')->nullable();
            $table->text('logo');
            $table->json('fonts');
            $table->json('sections');
            $table->json('ads');
            $table->json('home');
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
        Schema::dropIfExists('welcomes');
    }
}
