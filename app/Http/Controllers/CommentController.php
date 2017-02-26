<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Events\CommentRecieved;
use droosak\Comments;
use droosak\Videos;

class CommentController extends Controller
{


    public function addComment()
    {

      $parent = request()->input('parent') ?? '';

      broadcast(new CommentRecieved(request()->all() , false , $parent))->toOthers();


       Comments::create([
             'id' => request()->input('id'),
             'video_id' => request()->input('_videoID'),
             'user_id'  => auth()->user()->id,
             'body'     => request()->input('body'),
             'parent'   => $parent
          ]);
    }

    public function sendVoiceNote()
    {

      $audio  = basename(request()->file('audio')->store("voicenotes"));

      $parent = request()->input('parent') ?? '';

      broadcast(new CommentRecieved(request()->except('audio') , $audio , $parent))->toOthers();

      $video = Videos::where('id' , request()->input('_videoID')) ->first();

      $video->comments()->create([
        'id' => request()->input('id'),
        'body' => '',
        'voiceNote' => true,
        'voiceNote_src' => $audio,
        'user_id' => auth()->user()->id,
        'parent' => $parent
      ]);
    }


    public function moreComments()
    {

      return Comments::where('video_id' , request()->input('videoId'))
                     ->where('parent' , '')
                    ->with('user' , 'replies')->latest()
                     ->paginate(10);
    }
}
