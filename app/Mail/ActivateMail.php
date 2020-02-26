<?php

namespace Ares\Mail;

use Ares\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use RuntimeException;

class ActivateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \Ares\User
     */
    public $user;
    /**
     * @var bool
     */
    protected $register;
    /**
     * @var
     */
    protected $token;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param bool $register
     */
    public function __construct(User $user, $register = false)
    {
        if (empty($user) || empty($user['resetPass'])) {
            throw new RuntimeException('The supplied user has no generated token');
        }

        $this->user = $user;
        $this->token = $user['resetPass'];
        $this->register = $register;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = $this->register
            ? 'Please complete your registration for ARES DIGITAL 3.0'
            : 'Please activate your ARES DIGITAL 3.0 account';

        return $this->markdown('emails.activate', [
            'token' => $this->token,
            'tokenType' => $this->register
                ? 'register'
                : 'activate'
        ]);
    }
}
