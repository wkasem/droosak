<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Playlist;
use droosak\Videos;
use droosak\User;
use droosak\Stream;
use Dacast;
use droosak\Notifications\LiveEvent;
use FFMpeg;


class StreamController extends Controller
{
  public function on()
  {

    $this->validate(request() , [
      'title' => 'required'
    ]);

    $id = str_random(15);

    \Notification::send(students(), new LiveEvent($id , \Auth::user()));

    $stream = Dacast::Live()->create(request()->only('title' , 'discription'));

    request()->merge([
      'video_id' => $id,
      'by'  => auth()->user()->id,
      'live' => 1
    ]);

    $video = Playlist::where('title' , 'live')->first()->videos()->create(request()->all());

    Stream::create([
      'video_id' => $id,
      'stream_id' => $stream['id'],
      "stream_name" => $stream['config']['stream_name'],
      "login" => $stream['config']['login'],
      "password" => $stream['config']['password'],
      'src' => $stream['share_code']['facebook']
    ]);

    return redirect()->route('home.video' , compact('id'));
  }

  public function off()
  {
    Videos::where('video_id' , request('videoId'))->update([ 'live' => 3 ]);
    Stream::where('stream_id' , request('streamId'))->delete();

    Dacast::Live()->delete(['id' => request('streamId')]);
  }


  public function uploadVideo($id)
  {

      $this->validate(request(), [
        'video' => 'required|file|mimes:flv,mp4'
      ]);

      $filesrc  = basename(request()->file('video')->store("playlists/$id/_videos"));
      $filename = pathinfo(request()->file('video')->getClientOriginalName() , PATHINFO_FILENAME);
      $thumb    = sprintf("%s.png" , str_random(40));

      FFMpeg::open("playlists/$id/_videos/$filesrc")
          ->getFrameFromSeconds(1)
          ->export()
          ->toDisk("local")
          ->save("playlists/$id/_thumbs/$thumb");

      Videos::where('video_id' , request('videoId'))->update([
                  'src'          => $filesrc,
                  'thumb_src'    => $thumb
             ]);

  }
}
