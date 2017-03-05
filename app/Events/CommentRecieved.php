<?php

namespace droosak\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CommentRecieved implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $comment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment , $voiceNote = false , $parent = '')
    {

      if($voiceNote){
        $comment['voiceNote']     = true ;
        $comment['voiceNote_src'] = $voiceNote;
      }

      $comment['user'] = auth()->user();
      $comment['replies'] = [];
      $comment['created_at'] = date("Y-m-d H:i:s");

      $this->comment = $comment;

    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {

        return new PrivateChannel('video.'. $this->comment['_videoID']);
    }
}
