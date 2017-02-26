<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Playlist;
use droosak\Videos;
use droosak\User;
use droosak\Stream;
use Dacast;
use droosak\Notifications\LiveEvent;


class StreamController extends Controller
{
  public function on()
  {

    $this->validate(request() , [
      'title' => 'required'
    ]);

    $id = str_random(15);

    \Notification::send(User::all(), new LiveEvent($id , \Auth::user()));

    $stream = Dacast::Live()->create(request()->only('title' , 'discription'));

    request()->merge([
      'id' => $id,
      'by'  => auth()->user()->id,
      'live' => 1
    ]);

    $video = Playlist::find(1)->videos()->create(request()->all());

    Stream::create([
      'video_id' => $id,
      'stream_id' => $stream['id'],
      "stream_name" => $stream['config']['stream_name'],
      "login" => $stream['config']['stream_name'],
      "password" => $stream['config']['stream_name'],
      'src' => $stream['share_code']['facebook']
    ]);

    return redirect()->route('home.video' , compact('id'));
  }

  public function off($id)
  {

    $video = Videos::find($id)->first();

    Dacast::Live()->delete(['id' , $video->stream_id]);
  }
}
