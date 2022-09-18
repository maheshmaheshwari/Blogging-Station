<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

{{ __('Hello') }},

{{ __('You have a new article added') }}

{{ __('Article Title') }}: {{ $article->title }}

{{ __('Article URL') }}: {{ route('admin.articles.newPendingEdit', [$article->id]) }}

<?= __('Username') ?>: <?= $article->user->username ?>

<?= __('Email') ?>: <?= $article->user->email ?>

@if($reason)
    {{ __('Please check the following author message:') }}
    <?= nl2br(e($reason)) ?>
@endif

{{ __('Thanks,') }}
{{ get_option('site_name') }}
