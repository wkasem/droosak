<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('cv_src')->nullable();
            $table->longText('about')->nullable();
            $table->string('profile_pic')->nullable();
            $table->integer('type_id');
            $table->integer('points')->default(0);
            $table->integer('phone_code')->nullable();
            $table->integer('stage_id')->nullable();
            $table->text('mail_code')->nullable();
            $table->text('phone_number')->nullable();
            $table->string('ip')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
