<?php

namespace App\Mail;

use App\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminNewWithdrawal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Withdraw
     */
    protected $withdraw;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Withdraw $withdraw)
    {
        $this->withdraw = $withdraw;
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
            ->to(get_option('admin_email'), get_option('site_name'))
            ->subject(__(":site-name: New Withdrawal Request", ['site-name' => e(get_option('site_name'))]))
            ->view('emails.admin_new_withdrawal')
            ->text('emails.admin_new_withdrawal_plain')
            ->with([
                'withdraw' => $this->withdraw,
            ]);
    }
}
