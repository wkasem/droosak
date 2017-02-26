<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Playlist;
use droosak\Videos;

use FFMpeg;
use Storage;
use Streamer;

class VideoController extends Controller
{


  public function index()
  {
    $playlists = Playlist::withCount(['videos'])->get()->chunk(3);

    return view('admin.playlists' , compact('playlists'));
  }

  public function addPlaylist()
  {

    $this->validate(request() , [
      'title' => 'required|min:3|unique:playlists'
    ]);

    request()->merge(['playlist_id' => str_random(5)  , 'show' => true ]);

    $playlist = Playlist::create(request()->all());

    Storage::makeDirectory(sprintf('playlists/%s/_videos' , $playlist->playlist_id));
    Storage::makeDirectory(sprintf('playlists/%s/_thumbs' , $playlist->playlist_id));

    return $playlist;
  }

  public function getPlaylist($id)
  {

    $playlist = collect(Playlist::where('playlist_id' , $id)->with('videos.published_by')->first());

    if(!$playlist) return redirect()->route('admin.index');

    $playlist->put('videos' , collect($playlist->get('videos'))->chunk(3));

    return view('admin.playlist_videos' , compact('playlist'));
  }

  public function getVideo($id)
  {

    $video = Videos::where('video_id' , $id)
                   ->with(['playlist' , 'comments.replies' , 'published_by' , 'stream'])
                   ->withCount(['comments'])
                   ->first();

    return view('video', compact('video'));
  }

  public function streamVideo($id)
  {
    $video = Videos::where('video_id' , $id)->first();

    if(array_key_exists('range' , \Request::header() )){
      Streamer::create(sprintf("playlists/%s/_videos/%s" , $video->playlist_id , $video->src))->start();
    }

  }

  public function getThumb($id)
  {

       $video = Videos::where('video_id' , $id)->first();;

       $img = Storage::get(sprintf("playlists/%s/_thumbs/%s" , $video->playlist_id , $video->thumb_src));

       $ext = pathinfo($video->thumb_src , PATHINFO_EXTENSION);

       return response($img)
            ->header('Content-Type', "image/{$ext}");
  }

  public function uploadVideo($id)
  {

      $this->validate(request(), [
        'title' => 'required|min:3',
        'discription' => 'min:10',
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

      $video  = Playlist::where('playlist_id' , $id)->first()->videos()->create([
                  'video_id'     => str_random(5),
                  'src'          => $filesrc,
                  'thumb_src'    => $thumb,
                  'title'        => request()->input('title'),
                  'discription'  => request()->input('discription'),
                  'by'           => auth()->user()->id
                ]);

    $video->load('published_by');

    return $video;

  }

  public function updateVideo()
  {
    $this->validate(request(), [
      'title' => 'required|min:3',
      'discription' => 'min:10'
    ]);

     Videos::where('video_id' , request()->input('videoid'))
          ->update(request()->only('title' , 'discription'));
  }

  public function deleteVideo()
  {

    if(!\Hash::check(request()->input('password') , auth()->user()->password )){

      return abort(403, 'Unauthorized action.');
    }

    Videos::where('video_id' , request()->input('videoid'))->delete();

  }
}
