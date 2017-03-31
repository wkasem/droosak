<?php

namespace droosak\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\NexmoMessage;



class LiveEvent extends Notification implements ShouldQueue
{
    use Queueable;

    public $video;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($id , $user)
    {
        $this->video = \droosak\Videos::where('video_id', $id )->first();
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $notifiable->channels();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                 ->subject('فى بث حى الان' . $this->user->username)
                 ->view('mail.live',[
                   'user' => $this->user,
                   'video'=> $this->video
                 ]);
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content($this->user->username . ' is Live Now on droosak.com')
                    ->unicode();
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toArray($notifiable)
    {
        return [
          'user' => $this->user,
          'video' => $this->video
        ];
    }


}
