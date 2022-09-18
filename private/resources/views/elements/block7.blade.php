<?php
/**
 * @var \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder|\App\Article[] $articles
 */

$articles = \App\Article::getArticles($attributes);
$categories = \App\Category::whereIn('id', array_map('trim', explode(',', $attributes['cats'])))->get();
?>

<div class="block block7" id="b-{{ uniqid() }}" data-action="block7"
     data-perPage="{{ $attributes['per_page'] }}"
     data-spinner="{{ $attributes['spinner'] }}"
     data-cats="{{ $attributes['cats'] }}"
     data-summaryLength="{{ $attributes['summary_length'] }}"
     data-pagination="{{ $attributes['pagination'] }}" data-loadedPages="1" data-currentPage="1"
     data-orderBy="{{ $attributes['order_by'] }}"
     data-order="{{ $attributes['order'] }}">

    <div class="block-header">
        <div class="block-title"><span>{{ $attributes['title'] }}</span></div>
        <div class="block-cats">
            @if( $attributes['filter'] === 'yes' && count($categories))
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="nav-cat" href="#" data-category="{{ $attributes['cats'] }}">
                            {{ __('All') }}
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li class="list-inline-item">
                            <a class="nav-cat" href="#" data-category="{{ $category->id }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="block-content">
        <div data-loadedPage="{{ $attributes['page'] }}">

            @foreach($articles as $article)
                <div class="block-item block-item-big">
                    <div class="block-item-img">
                        <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}"
                           style="background-image: url('{{ $article->getMainImage('medium') }}')"></a>
                        <div class="block-item-category"
                             style="background-color: {{ (string)$article->getMainCategory()->color }};">
                            <a href="{{ route('category.show', ['slug' => $article->getMainCategory()->slug, 'category' => $article->getMainCategory()->id]) }}">
                                {{ $article->getMainCategory()->name }}
                            </a>
                        </div>
                    </div>
                    <div class="block-item-overlay">
                        <div class="block-item-title">
                            <a href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">
                                {{ $article->title }}
                            </a>
                        </div>
                        <div class="block-item-meta">
                            <small><i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}</small>
                            -
                            <small>
                                <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                            </small>
                            -
                            <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                        </div>
                        <div class="block-item-content">
                            {{ $article->getSummary() }}
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- $articles->appends(request()->except(['page']))->links('pagination.'.$attributes['pagination']) --}}

        </div>
    </div>
</div>
