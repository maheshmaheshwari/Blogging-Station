<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(get_option('email_from', 'no_reply@localhost'), get_option('site_name'))
            ->to($this->user->email, $this->user->name)
            ->subject(__(":site-name: Password Reset", ['site-name' => e(get_option('site_name'))]))
            ->view('emails.password_reset')
            ->text('emails.password_reset_plain')
            ->with([
                'user' => $this->user,
            ]);
    }
}
