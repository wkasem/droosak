<?php

namespace droosak\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageRecieved implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $msg;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg , $voiceNote = false)
    {

        if($voiceNote){
          $msg = [
            'body' => '',
            'voiceNote' => true,
            'voiceNote_src' => $voiceNote,
            'user_id' => auth()->user()->id,
            'conversation_id' => $msg['conversation_id']
          ];
        }else{
          $msg['user_id'] = auth()->user()->id;
        }

        $msg['created_at'] = date("Y-m-d H:i:s");

        $this->msg = $msg;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('conversation.'.$this->msg['conversation_id']);
    }
}
