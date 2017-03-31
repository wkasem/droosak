<?php

namespace droosak\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class UserRegistration extends Notification implements ShouldQueue
{
    use Queueable;


    protected $phoneCode;

    protected $mailCode;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phoneCode , $mailCode)
    {
        $this->phoneCode = $phoneCode;

        $this->mailCode = $mailCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
       $via = ['nexmo'];

       if(!empty($this->mailCode)){
         $via[] = 'mail';
       }
        return $via ;
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
                    ->subject('Droosak.com Registration')
                    ->line('Droosak.com Code ')
                    ->line($this->mailCode);
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
                    ->content('Droosak.com Code:'.$this->phoneCode);
    }

}
