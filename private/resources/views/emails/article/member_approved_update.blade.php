<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

<p>{{ __('Hello') }},</p>

@if($article->status === 1)
    <p>{!! __('Congratulations your new update for article :article-title has been approved.', ['article-title' => '<b>'.$article->title.'</b>']) !!}</p>
@endif

@if($article->status === 6)
    <p>{!! __('Your article :article-title needs some improvements.', ['article-title' => '<b>'.$article->title.'</b>']) !!}</p>
@endif

@if($reason)
    <p>
        <b>{{ __('Please check the following reviewer message:') }}</b><br>
        <i><?= nl2br(e($reason)) ?></i>
    </p>
@endif

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
