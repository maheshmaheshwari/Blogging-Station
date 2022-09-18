<?php

namespace App\Mail;

use App\Withdraw;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberCompletedWithdrawal extends Mailable
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
            ->to($this->withdraw->user->email, $this->withdraw->user->username)
            ->subject(__(":site-name: Your Request for Withdrawal has been Processed",
                ['site-name' => e(get_option('site_name'))]))
            ->view('emails.member_completed_withdrawal')
            ->text('emails.member_completed_withdrawal_plain')
            ->with([
                'withdraw' => $this->withdraw,
            ]);
    }
}
