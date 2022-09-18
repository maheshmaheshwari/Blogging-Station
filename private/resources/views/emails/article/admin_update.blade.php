<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

<p>{{ __('Hello') }},</p>

<p>{{ __('Please check the following Article:') }}</p>

<p>
    {{ __('Article id') }}: {{ $article->id }}<br>
    {{ __('Article title') }}: <a
        href="{{ route('admin.articles.updatePendingEdit', [$article->id]) }}">{{ $article->title }}</a><br>
    {{ __('Article status') }}: {{ get_article_statuses($article->status) }}
</p>

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
