<?php

namespace droosak\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExamPublished extends Notification implements ShouldQueue
{
    use Queueable;

    public $exam;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($exam)
    {
        $this->exam = $exam;
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
      \App::setLocale('ar');

      return (new MailMessage)
                  ->subject(" دروسك.كوم :" . \Lang::get('exams.'.$this->exam['title']))
                  ->view('mail.exam' , ['exam' => $this->exam]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'exam' => $this->exam
        ];
    }
}
