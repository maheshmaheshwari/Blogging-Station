<?php
/**
 * @var \App\Category $category
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Article[] $articles
 */
?>
@extends('layouts.front')

@section('title', e(__('Search')))
@section('description', e(__('Search')))

@section('content')
    <main role="main" class="container">

        <div class="row">
            <div class="col-lg-8">
                <div class="col-inner main-listing">
                    <h3>{{ __('Search results for:') }} {{ $keyword }}</h3>

                    <p>{{ __('If you are not happy with the results below please do another search.') }}</p>

                    <form method="get" action="{{ route('search') }}" class="">
                        <div class="form-group">
                            <input type="text" name="q" placeholder="{{ __('Search keywords') }}" class="form-control"
                                   value="{{ $keyword }}" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="{{ __('Search') }}">
                        </div>
                    </form>

                    @if($keyword)
                        <div class="row">
                            <?php $count = 0; ?>
                            @foreach($articles as $article)
                                @if($count % 5 === 0)
                                    <div class="block-item block-item-big col-sm-12 col-lg-12">
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
                                                <small><i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}
                                                </small>
                                                <small>
                                                    <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                                                </small>
                                                -
                                                <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                                            </div>
                                            <div class="block-item-content">
                                                {{ $article->getSummary() }}
                                            </div>
                                            <a class="read-more"
                                               href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">
                                                {{ __('Read More') }}
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="block-item col-sm-6 col-lg-6">
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
                                            <small><i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}
                                            </small>
                                            <small>
                                                <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                                            </small>
                                            -
                                            <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                                        </div>
                                        <div class="block-item-content">
                                            {{ $article->getSummary(20) }}
                                        </div>
                                        <a class="read-more"
                                           href="{{ route('article.show', ['slug' => $article->slug, 'article' => $article->id]) }}">
                                            {{ __('Read More') }}
                                        </a>
                                    </div>
                                @endif
                                <?php $count++; ?>
                            @endforeach
                        </div>

                        <div class="table-responsive">
                            {{ $articles->appends(request()->except(['page']))->links() }}
                        </div>

                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('search_sidebar') ) !!}
                </div>
            </div>
        </div>

    </main><!-- /.container -->
@endsection
