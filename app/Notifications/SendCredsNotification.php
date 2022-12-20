<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendCredsNotification extends Notification
{
    use Queueable;
    private $name;
    private $email;
    private $passord;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
           ->subject('LabelDots Login Details')
                    ->greeting('Dear '.$this->name.',')
                    ->line('We wish to inform you that an account has been created for you by LabelDots')
                    ->line('Login with email: '.$this->email.' '. 'Password: ' .$this->password)
                    ->action('Access your Account here', url('https://labeldots.com.ng'))
                    ->line('Thank you for using LabelDots!');
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
            //
        ];
    }
}
