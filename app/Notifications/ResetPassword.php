<?php

namespace App\Notifications;

use Config;
use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = Config::get('mail.from.address');
        return (new MailMessage)
            ->from($mail, config('mail.from.name'))
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(config('app.url') . '/reset-password/' . $this->token) . '?email=' . urlencode($notifiable->email))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
