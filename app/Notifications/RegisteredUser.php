<?php

namespace Ares\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredUser extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param string $token
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param mixed $notifiable
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject(Lang::getFromJson('Registration Successful Notification'))
            ->line(Lang::getFromJson('You are receiving this email because you a new user was registered with this email address on Ares Digital 3.0.'))
            ->action(Lang::getFromJson('Activate'), url(config('app.url') .
                                                        route('password.reset', ['token' => $this->token], false)))
            ->line(Lang::getFromJson('This activation link will expire in 24 hours.'))
            ->line(Lang::getFromJson('If you did create an account, please contact us at support@axanarproductions.com.'));
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param \Closure $callback
     *
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
