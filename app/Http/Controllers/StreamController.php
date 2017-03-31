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

  protected $video_id;

  public function on()
  {

    $this->create();

    return redirect()->route('home.video' ,['id' => $this->video_id]);
  }

  public function adminOn()
  {

    $this->create(request('teacher') , request('playlist_id') , request('points'));
  }

  protected function create($by_user = null , $playlist_id = null , $points = 20)
  {
    $this->validate(request(), [
      'title' => 'required|min:3',
      'discription' => 'min:10'
    ]);

    $this->video_id = str_random(15);
    $by_user = ($by_user) ? User::where('id' , $by_user)->first() : auth()->user();

    $stream = Dacast::Live()->create(request()->only('title' , 'discription'));

    request()->merge([
      'video_id' => $this->video_id,
      'by'  => $by_user->id,
      'created_by' => auth()->user()->id,
      'points' => $points,
      'live' => 1
    ]);

    if($playlist_id){
      $playlist = Playlist::where('playlist_id' , $playlist_id)
                       ->first();
    }else{
      $playlist = Playlist::where('title' , 'live')->first();
    }

    $video = $playlist->videos()->create(request()->all());

    \Notification::send(students($playlist->stage_id), new LiveEvent($this->video_id , $by_user));

    Stream::create([
      'video_id' => $this->video_id,
      'stream_id' => $stream['id'],
      "stream_name" => $stream['config']['stream_name'],
      "login" => $stream['config']['login'],
      "password" => $stream['config']['password'],
      'src' => $stream['share_code']['facebook']
    ]);

    return $video;
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
