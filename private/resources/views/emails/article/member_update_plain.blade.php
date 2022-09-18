<?php
/**
 * @var \App\Article $article
 * @var string $reason
 */
?>

{{ __('Hello') }},

{{ __('Article title') }}: {{ $article->title }}
{{ __('Article status') }}: {{ get_article_statuses($article->status) }}

{{ __('Please check the following reviewer message:') }}
<?= nl2br(e($reason)) ?>

{{ __('Thanks,') }}
{{ get_option('site_name') }}
