<?php

namespace App\Mail;

use App\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberUpdateArticle extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var \App\Article
     */
    protected $article;

    /**
     * @var string
     */
    protected $reason;

    /**
     * Create a new message instance.
     *
     * @param Article $article
     * @param string $message
     */
    public function __construct(Article $article, $reason = null)
    {
        $this->article = $article;
        $this->reason = $reason ?? '';
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
            ->replyTo(get_option('admin_email'), get_option('site_name'))
            ->to($this->article->user->email, $this->article->user->name)
            ->subject(__("Article Update"))
            ->view('emails.article.member_update')
            ->text('emails.article.member_update_plain')
            ->with([
                'article' => $this->article,
                'reason' => $this->reason,
            ]);
    }
}
