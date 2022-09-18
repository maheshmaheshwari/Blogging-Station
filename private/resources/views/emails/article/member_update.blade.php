<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

<p>{{ __('Hello') }},</p>

<p>
    {{ __('Article title') }}: {{ $article->title }}<br>
    {{ __('Article status') }}: {{ get_article_statuses($article->status) }}
</p>

<p>
    <b>{{ __('Please check the following reviewer message:') }}</b><br>
    <i><?= nl2br(e($reason)) ?></i>
</p>

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
