<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;

class UserChanges extends Notification
{
    use Queueable;
    use Notifiable;

    private $enrollmentData;
    /**
     * Create a new notification instance.
     */
    public function __construct($enrollmentData)
    {
        $this->enrollmentData = $enrollmentData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
//        return (new MailMessage)
////                    ->from('wizbok245@gmail.com')
////                    ->to('mytest@gmail.com')
//                    ->subject('Activity on your account')
//                    ->line($this->enrollmentData['body'])
//                    ->action($this->enrollmentData['enrollmentText'], $this->enrollmentData['url'])
//                    ->line($this->enrollmentData['thankyou']);
   $email = $this->enrollmentData['body'];
                 return (new MailMessage)
                         ->view('email.user_changes', ['email' => $email])->subject('Password change')->from('donot@blog.com');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
    
     public function User()
    {
      return $this->hasMany('App\Models\User'); 
     
    }
}
