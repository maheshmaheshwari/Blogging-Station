<?php
/**
 * @var \App\Article $article
 */
?>

@extends('layouts.front')

@php
    $seoTitle = $article->seo['title'] ?? $article->title;
    $seoDescription = $article->seo['description'] ?? $article->getMetaDescription();
    $seoKeywords = (!empty($article->seo['keywords'])) ? e($article->seo['keywords']) : null;
@endphp
@section('title', e($seoTitle))
@section('description', e($seoDescription))
@section('keywords', $seoKeywords)

@push('header')
    <meta property="og:type" content="article"/>
    <meta property="article:section" content="{{ $article->getMainCategory()->name }}"/>
    @if($article->published_at)
        <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}"/>
    @endif
    <meta property="article:modified_time" content="{{ $article->updated_at->toIso8601String() }}"/>
    <meta property="og:url" content="{{ $article->permalink() }}"/>
    <meta property="og:title" content="{{ $seoTitle }}" />
    <meta property="og:description" content="{{ $seoDescription }}" />
    <meta property="og:image" content="{{ asset($article->getMainImage('large')) }}"/>
    <meta property="og:image:width" content="1024"/>
    <meta property="og:image:height" content="615"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $article->title }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ asset($article->getMainImage('large')) }}">

    <script type="text/javascript">
        if (window.self !== window.top) {
            window.top.location.href = window.location.href;
        }
    </script>
@endpush

@push('body_class', ' article-show')

@section('content')
    <div class="article-main-image-bg"
         style="background-image: url('{{ asset($article->getMainImage('large')) }}');"></div>
    <main role="main" class="container article-main-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="col-inner">
                    <h1 class="article-title">{{ $article->title }}</h1>

                    <div class="article-meta">
                        <small><i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}</small>
                        -
                        <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                        -
                        <small>
                            <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                        </small>
                    </div>

                    <div class='article-share'>
                        <a class='share-btn share-btn-facebook'
                           href='https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class='fab fa-facebook-f'></i> <span>Facebook</span>
                        </a>
                        <a class='share-btn share-btn-twitter'
                           href='https://twitter.com/intent/tweet?text=<?= urlencode($article->title) ?>&amp;url=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class='fab fa-twitter'></i> <span>Twitter</span>
                        </a>
                        <a class='share-btn share-btn-linkedin'
                           href='https://www.linkedin.com/cws/share?url=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-linkedin-in"></i> <span>Linkedin</span>
                        </a>
                        <a class='share-btn share-btn-pinterest'
                           href='https://pinterest.com/pin/create/button/?url=<?= urlencode($article->permalink()) ?>&amp;media=<?= urlencode(asset($article->getMainImage('large'))) ?>&amp;description=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-pinterest"></i> <span>Pinterest</span>
                        </a>
                        <a class='share-btn share-btn-reddit'
                           href='https://www.reddit.com/submit?url=<?= urlencode($article->permalink()) ?>&amp;title=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-reddit-alien"></i> <span>reddit</span>
                        </a>
                        <a class='share-btn share-btn-vk'
                           href='https://vk.com/share.php?url=<?= urlencode($article->permalink()) ?>&amp;title=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-vk"></i> <span>VK</span>
                        </a>
                        <a class='share-btn share-btn-mail'
                           href='mailto:?subject={{ $article->title }}&amp;body={{ $article->permalink() }}'
                           rel='nofollow' target='_blank' title='via email'>
                            <i class="far fa-envelope"></i> <span>Email</span>
                        </a>
                    </div>

                    <?= applyShortCodes('[ads id="' . get_style('above_article_ad') . '"]') ?>

                    <div class="article-content">
                        {!! $article->getFinalContent() !!}
                    </div>

                    <?= applyShortCodes('[ads id="' . get_style('below_article_ad') . '"]') ?>

                    <script>
                        /* <![CDATA[ */
                        var read_time = <?= $article->read_time ?>;
                        /* ]]> */
                    </script>
                    <form action="{{ route('article-go') }}" method="post" id="view-form" style="display: none;">
                        @csrf
                        <input type="hidden" name="view_form_data" value="{{ $view_form_data }}">
                    </form>

                    <div class="article-tags">
                        <span
                            class="badge badge-secondary">{{ __('Explore more about') }}</span> {!! $article->tagsString() !!}
                    </div>

                    <div class='article-share'>
                        <a class='share-btn share-btn-facebook'
                           href='https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class='fab fa-facebook-f'></i> <span>Facebook</span>
                        </a>
                        <a class='share-btn share-btn-twitter'
                           href='https://twitter.com/intent/tweet?text=<?= urlencode($article->title) ?>&amp;url=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class='fab fa-twitter'></i> <span>Twitter</span>
                        </a>
                        <a class='share-btn share-btn-linkedin'
                           href='https://www.linkedin.com/cws/share?url=<?= urlencode($article->permalink()) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-linkedin-in"></i> <span>Linkedin</span>
                        </a>
                        <a class='share-btn share-btn-pinterest'
                           href='https://pinterest.com/pin/create/button/?url=<?= urlencode($article->permalink()) ?>&amp;media=<?= urlencode(asset($article->getMainImage('large'))) ?>&amp;description=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-pinterest"></i> <span>Pinterest</span>
                        </a>
                        <a class='share-btn share-btn-reddit'
                           href='https://www.reddit.com/submit?url=<?= urlencode($article->permalink()) ?>&amp;title=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-reddit-alien"></i> <span>reddit</span>
                        </a>
                        <a class='share-btn share-btn-vk'
                           href='https://vk.com/share.php?url=<?= urlencode($article->permalink()) ?>&amp;title=<?= urlencode($article->title) ?>'
                           rel='nofollow' target='_blank'>
                            <i class="fab fa-vk"></i> <span>VK</span>
                        </a>
                        <a class='share-btn share-btn-mail'
                           href='mailto:?subject={{ $article->title }}&amp;body={{ $article->permalink() }}'
                           rel='nofollow' target='_blank' title='via email'>
                            <i class="far fa-envelope"></i> <span>Email</span>
                        </a>
                    </div>

                    <div class="article-newsletter">
                        <p>
                            <i class="far fa-envelope"></i> {{ __('Enjoyed this article? Stay informed by joining our newsletter!') }}
                        </p>

                        <form method="post" action="{{ route('newsletter.subscribe') }}"
                              class="newsletter-subscribe form-inline">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" placeholder="mail@example.com" class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="{{ __('Subscribe') }}">
                            </div>
                        </form>
                    </div>

                    <div id="comments" class="article-comments mb-3">
                        <div class="block-header">
                            <div class="block-title"><span>{{ __('Comments') }}</span></div>
                        </div>

                        @if($article->activeComments()->count())
                            <div class="comments">
                                @include('public._partials._comment_replies', ['comments' => $article->activeComments(), 'article_id' => $article->id])
                            </div>
                        @endif

                        @guest
                            <p>{{ __('You must be logged in to post a comment.') }}</p>
                        @else
                            <div id="add-comment">
                                <h4>{{ __('Add comment') }}</h4>
                                <form method="post" action="{{ route('comment.add') }}">
                                    @csrf
                                    <input type="hidden" name="data" value="<?= encrypt([
                                        'article_id' => $article->id,
                                        'parent_id' => null
                                    ]) ?>"/>

                                    <div class="form-group">
                                    <textarea required name="content" class="form-control"
                                              placeholder="{{ __('Content') }}"></textarea>
                                    </div>

                                    <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}"/>
                                </form>
                            </div>
                        @endguest
                    </div>

                    @if($relatedArticles = $article->relatedArticles())
                        <div class="widget article-related mb-3">
                            <div class="block-header">
                                <div class="block-title"><span>{{ __('Related Articles') }}</span></div>
                            </div>
                            <div class="block-content">
                                <div class="row">
                                    @foreach($relatedArticles as $article)
                                        <div class="block-item col-sm-6 col-lg-4">
                                            <div class="block-item-img">
                                                <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}"
                                                   style="background-image: url('{{ $article->getMainImage('small') }}')"></a>
                                                <div class="block-item-category"
                                                     style="background-color: {{ (string)$article->getMainCategory()->color }};">
                                                    <a href="{{ route('category.show', ['slug' => $article->getMainCategory()->slug, 'category' => $article->getMainCategory()->id]) }}">
                                                        {{ $article->getMainCategory()->name }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="block-item-title">
                                                <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">
                                                    {{ $article->title }}
                                                </a>
                                            </div>
                                            <div class="block-item-meta">
                                                <small>
                                                    <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                                                </small>
                                                -
                                                <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('article_sidebar') ) !!}
                </div>
            </div>
        </div>

    </main><!-- /.container -->
@endsection

@push('footer')
    <script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
@endpush
