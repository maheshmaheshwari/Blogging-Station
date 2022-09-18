<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

<p>{{ __('Hello') }},</p>

<p>{{ __('You have a new article added') }}</p>

<p>{{ __('Article Title') }}" <a
        href="{{ route('admin.articles.newPendingEdit', [$article->id]) }}">{{ $article->title }}</a></p>

<p><?= __('Username') ?>: <?= $article->user->username ?></p>

<p><?= __('Email') ?>: <?= $article->user->email ?></p>

@if($reason)
    <p>
        {{ __('Please check the following author message:') }}<br>
        <i><?= nl2br(e($reason)) ?></i>
    </p>
@endif

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
