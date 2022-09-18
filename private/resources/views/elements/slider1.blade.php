<?php
$articles = \App\Article::with(['user', 'featuredImage', 'mainCategory'])
    ->latest('created_at')
    ->where('status', 1)
    ->paginate();
?>
<style>
    .owl-carousel .item {
        text-align: center;
    }

    .owl-carousel .item-img {
        position: relative;
    }

    .owl-carousel .item-title a {
        font-family: 'Roboto Slab', serif;
        font-size: 20px;
        font-weight: 500;
    }

    .owl-carousel .item-category {
        position: absolute;
        left: 10px;
        top: 10px;
        padding: 0 5px;
        color: #ffffff;
        font-size: 0.75rem;
    }
</style>
<div class="carousel-loop owl-carousel owl-theme">
    @foreach($articles as $article)
        <div class="item">
            <div class="item-img">
                <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">
                    <img src="{{ url( $article->getMainImage('medium') ) }}">
                </a>
                <div class="item-category" style="background-color: {{ (string)$article->getMainCategory()->color }};">
                    <a href="{{ route('category.show', ['slug' => $article->getMainCategory()->slug, 'category' => $article->getMainCategory()->id]) }}">
                        {{ $article->getMainCategory()->name }}
                    </a>
                </div>
            </div>
            <div class="item-title">
                <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">{{ $article->title }}</a>
            </div>
            <div class="item-meta">
                <small class="text-muted">
                    <i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}
                </small>
                -
                <small class="text-muted">
                    <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                </small>
                -
                <small class="text-muted"><i class="far fa-user"></i> {{ $article->user->name }}</small>
            </div>
        </div>
    @endforeach
</div>
