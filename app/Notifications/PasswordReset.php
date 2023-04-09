<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly string $token,
        private readonly string $email,
    )
    {
        //
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
        $url = env('BASE_URL', env('APP_URL')). '/password/reset?'.$this->token.'&email='.$this->email;
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.') // Here are the lines you can safely override
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required.');
//            ->salutation('Regards, '.'jairus');
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
}
