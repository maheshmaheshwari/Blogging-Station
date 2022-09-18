<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(get_option('email_from'), $this->data['name'])
            ->replyTo($this->data['email'], $this->data['name'])
            ->to(get_option('admin_email'), get_option('site_name'))
            ->subject(__(":site-name: Contact", ['site-name' => e(get_option('site_name'))]))
            ->view('emails.contact')
            ->text('emails.contact_plain')
            ->with([
                'email' => $this->data['email'],
                'name' => $this->data['name'],
                'body' => $this->data['body'],
            ]);
    }
}
