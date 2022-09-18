<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

{{ __('Hello') }},

@if($article->status === 1)
    {!! __('Congratulations your new article :article-title has been approved.', ['article-title' => '<b>'.$article->title.'</b>']) !!}
@endif

@if($article->status === 2)
    {!! __('Your new article :article-title has been rejected.', ['article-title' => '<b>'.$article->title.'</b>']) !!}
@endif

@if($article->status === 5)
    {!! __('Your article :article-title needs some improvements.', ['article-title' => '<b>'.$article->title.'</b>']) !!}
@endif

@if($reason)
    {{ __('Please check the following reviewer message:') }}
    <?= nl2br(e($reason)) ?>
@endif

{{ __('Thanks,') }}
{{ get_option('site_name') }}
