<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

{{ __('Hello') }},

{{ __('Please check the following Article:') }}

{{ __('Article id') }}: {{ $article->id }}
{{ __('Article title') }}" {{ $article->title }}
{{ __('Article URL') }}" {{ route('admin.articles.updatePendingEdit', [$article->id]) }}
{{ __('Article status') }}" {{ get_article_statuses($article->status) }}

@if($reason)
    {{ __('Please check the following author message:') }}
    <?= nl2br(e($reason)) ?>
@endif

{{ __('Thanks,') }}
{{ get_option('site_name') }}
