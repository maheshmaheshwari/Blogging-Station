<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

{{ __('Hello') }},

@if($article->status === 1)
    {!! __('Congratulations your new update for article :article-title has been approved.', ['article-title' => '<b>'.$article->title.'</b>']) !!}
@endif

@if($article->status === 6)
    {!! __('Your article :article-title needs some improvements.', ['article-title' => '<b>'.$article->title.'</b>']) !!}
@endif

@if($reason)
    {{ __('Please check the following reviewer message:') }}
    <?= nl2br(e($reason)) ?>
@endif

{{ __('Thanks,') }}<br>
{{ get_option('site_name') }}

