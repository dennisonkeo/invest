<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class HelloUser extends Notification
{
    use Queueable;


protected $amount;
protected $direct;
protected $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount,$direct,$name)
    {
        $this->amount = $amount;
        $this->direct = $direct;
        $this->name = $name;
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
                    ->subject('Payment')
                    ->line('congratulations, you have earned ksh '.$this->amount .' by referring '.$this->name .' '.$this->direct)
                    // ->action('Notification Action', url('/'))
                    ->line('');
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
