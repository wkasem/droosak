<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Playlist;
use droosak\Videos;
use droosak\View;
use droosak\User;

use FFMpeg;
use Storage;
use File;
use Streamer;
use Points;
use droosak\Stage;

use Dilab\Network\SimpleRequest;
use Dilab\Network\SimpleResponse;
use Dilab\Resumable;

class VideoController extends Controller
{


  public function index()
  {
    $playlists = Playlist::noparent()->withCount(['videos'])->get()->chunk(3);

    $stages = Stage::all()->map(function($s){
      $s->title = \Lang::get('exams.'.$s->title);
      return $s;
    });

    return view('admin.playlists' , compact('playlists' , 'stages'));
  }

  public function updatePoster($id)
  {
    $this->validate(request(),[
      'poster' => 'required|file|mimes:png,jpg,jpeg'
    ]);

    $file = request()->file('poster');

    $path = $file->hashName(sprintf('playlists/%s' , $id));

    $image = \Image::make($file);

    $image->resize(370, 280);

     \Storage::put($path, (string) $image->encode());

     $playlist = Playlist::where('playlist_id' , $id)->first();

     if($playlist->poster){
       Storage::delete(sprintf("playlists/%s/%s" , $id , $playlist->poster));

     }
     $playlist->update([ 'poster' => basename($path) ]);

    return basename($path);
  }
  public function addPlaylist()
  {

    $this->validate(request() , [
      'title' => 'required|min:3|unique:playlists'
    ]);

    $id = str_random(5);

    request()->merge(['playlist_id' => $id  , 'show' => true ]);


    $playlist = Playlist::create(request()->all());

    Storage::makeDirectory(sprintf('playlists/%s/_videos' , $id));
    Storage::makeDirectory(sprintf('playlists/%s/_thumbs' , $id));

    $playlist->playlist_id = $id;
    return $playlist;
  }

  public function getPlaylist($id)
  {

    $playlist = collect(Playlist::where('playlist_id' , $id)
                     ->with(['playlists' , 'videos.published_by' , 'documents'])->first());

    if(!$playlist->count()) return redirect()->route('admin.index');

    $playlist->put('videos' , collect($playlist->get('videos'))->chunk(3));
    $playlist->put('playlists' , collect($playlist->get('playlists'))->chunk(3));

    $teachers = User::teachers()->get();

    $playlists = Playlist::show()->get();

    return view('admin.playlist_videos' , compact('playlist' , 'teachers' , 'playlists'));
  }

  public function getVideo($id)
  {


    $promotion  = Playlist::where('title' , 'promotion')
                          ->first()
                          ->videos()->inRandomOrder()->first();

    $video = Videos::where('video_id' , $id)
                   ->with([
                     'playlist' ,
                     'comments.replies_count' ,
                     'published_by' ,
                     'stream'
                   ])
                   ->withCount(['comments' , 'views'])
                   ->first();
     if(student()){
       Points::subtract($video);
       View::create([
         'video_id' => $id,
         'user_id' => auth()->user()->id,
         'owner_id' => $video->by
       ]);
     }
    return view('video', compact('video' , 'promotion'));
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

  public function getPoster($id , $poster)
  {


       $img = Storage::get(sprintf("playlists/%s/%s" , $id , $poster));

       $ext = pathinfo($poster , PATHINFO_EXTENSION);

       return response($img)
            ->header('Content-Type', "image/{$ext}");
  }

  public function uploadVideo($id)
  {


            $tmpPath    = storage_path().'/tmp';
            $uploadPath = storage_path('app')."/playlists/$id/_videos";
            if(!File::exists($tmpPath)) {
                File::makeDirectory($tmpPath, $mode = 0777, true, true);
            }

            if(!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, $mode = 0777, true, true);
            }

            $simpleRequest              = new SimpleRequest();
            $simpleResponse             = new SimpleResponse();

            $resumable                  = new Resumable($simpleRequest, $simpleResponse);
            $resumable->tempFolder      = $tmpPath;
            $resumable->uploadFolder    = $uploadPath;


            $result = $resumable->process();

            switch($result) {
                case 200:
                    return response([
                        'message' => 'OK',
                    ], 200);
                    break;
                case 201:
                    $video = $this->persistVideo($uploadPath , $id);
                    return response(compact('video'), 200);
                    break;
                case 204:
                    return response([
                        'message' => 'Chunk not found',
                    ], 204);
                    break;
                default:
                    return response([
                        'message' => 'An error occurred',
                    ], 404);
            }


  }

  public function persistVideo($uploadPath , $id)
  {

      $name = request('resumableFilename');
      $fileExt  = pathinfo($name , PATHINFO_EXTENSION);
      $filename = md5($name).'.'.$fileExt;

      File::move($uploadPath.'/'.$name , $uploadPath.'/'.$filename);

      $thumb    = sprintf("%s.png" , str_random(40));

      FFMpeg::open("playlists/$id/_videos/$filename")
          ->getFrameFromSeconds(1)
          ->export()
          ->toDisk("local")
          ->save("playlists/$id/_thumbs/$thumb");

      $videoID = str_random(5);

      $video  = Playlist::where('playlist_id' , $id)->first()->videos()->create([
                  'video_id'     => $videoID,
                  'src'          => $filename,
                  'thumb_src'    => $thumb,
                  'title'        => request('title'),
                  'discription'  => request('discription'),
                  'by'           => request('published_by') ?? 1,
                  'points'       => request('points') ?? 0
                ]);

    $video->load(['published_by' , 'views']);
    $video->video_id = $videoID;

    return $video;
  }

  public function updateVideo()
  {
    $this->validate(request(), [
      'title' => 'required|min:3',
      'discription' => 'min:10'
    ]);

     $video = Videos::where('video_id' , request()->input('videoid'))->first();

     if($video->playlist_id != request('playlist_id')){
       \Storage::move(
           sprintf('playlists/%s/_videos/%s' , $video->playlist_id , $video->src),
           sprintf('playlists/%s/_videos/%s' , request('playlist_id') , $video->src)
       );
       \Storage::move(
           sprintf('playlists/%s/_thumbs/%s' , $video->playlist_id , $video->thumb_src),
           sprintf('playlists/%s/_thumbs/%s' , request('playlist_id') , $video->thumb_src)
       );
     }

      $video->update(request()->only('title' , 'discription' , 'points' , 'playlist_id'));
  }

  public function deleteVideo()
  {

    if(!\Hash::check(request()->input('password') , auth()->user()->password )){

      return abort(403, 'Unauthorized action.');
    }

    Videos::where('video_id' , request()->input('videoid'))->delete();

  }
}
