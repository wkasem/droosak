<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists_videos', function (Blueprint $table) {
            $table->text('video_id');
            $table->text('playlist_id');
            $table->string('src')->nullable();
            $table->string('thumb_src')->nullable();
            $table->string('title');
            $table->text('discription')->nullable();
            $table->integer('by')->nullable();
            $table->integer('stream_id')->nullable();
            $table->integer('live')->default(0);
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
        Schema::dropIfExists('playlists_videos');
    }
}
