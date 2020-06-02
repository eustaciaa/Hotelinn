<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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

        $link = url( "/password/reset/?token=" . $this->token );

        return (new MailMessage)
                    ->view('vendor.notifications.email')
                    ->subject('Memulihkan Password')
                    ->greeting('Halo')
                    ->line('Kamu menerima email ini karena kami menerima permintaan kamu untuk memulihkan password')
                    ->action('Pulihkan password', $link)
                    ->line('Link ini akan kadarluwarsa dalam 60 menit')
                    ->line('Abaikan jika kamu tidak meminta untuk memulihkan password')
                    ->salutation("Salam,
                    Hotelinn");
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
