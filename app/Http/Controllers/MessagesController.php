<?php

namespace droosak\Http\Controllers;

use Illuminate\Http\Request;

use droosak\Conversations;
use droosak\Events\MessageRecieved;
use Streamer;
use Conversation;

class MessagesController extends Controller
{


    public function index($id = null)
    {

      $conversations = Conversation::get($id);

      return view('messages' , compact('conversations'));
    }

    public function sendMessage()
    {

      broadcast(new MessageRecieved(request()->all()))->toOthers();

      $conversation = Conversations::where('id' , request()->input('conversation_id'))
                                    ->first();

      $conversation->messages()->create([
        'body' => request()->input('body'),
        'user_id' => auth()->user()->id
      ]);
    }

    public function sendVoiceNote()
    {



      $audio  = basename(request()->file('audio')->store("voicenotes"));

      broadcast(new MessageRecieved(request()->all() , $audio))->toOthers();

      $conversation = Conversations::where('id' , request()->input('conversation_id'))
                                    ->first();

      return $conversation->messages()->create([
        'body' => '',
        'voiceNote' => true,
        'voiceNote_src' => $audio,
        'user_id' => auth()->user()->id
      ]);
    }

    public function streamVoiceNote($src)
    {

      Streamer::create(sprintf("voicenotes/%s" , $src))->start();
    }

    public function markAsSeen()
    {
      $conversation = Conversations::where('id' , request()->input('conversation_id'))->first();

      $conversation->messages()->where('user_id' , request()->input('user_id'))
                    ->update(['seen' => true]);

    }
}
