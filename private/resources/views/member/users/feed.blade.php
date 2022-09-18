@extends('layouts.member')

@section('title', e(__('My feed')))

@section('content')
    <div class="main-listing">
        <div class="row">
            <?php $count = 0; ?>
            @foreach($articles as $article)
                @if($count % 5 === 0)
                    <div class="block-item block-item-big col-sm-12 col-lg-12">
                        <div class="block-item-img">
                            <a href="{{ $article->permalink() }}"
                               style="background-image: url('{{ $article->getMainImage('medium') }}')"></a>
                            <div class="block-item-category"
                                 style="background-color: {{ $article->getMainCategory()->color }};">
                                <a href="{{ route('category.show', ['slug' => $article->getMainCategory()->slug, 'category' => $article->getMainCategory()->id]) }}">
                                    {{ $article->getMainCategory()->name }}
                                </a>
                            </div>
                        </div>
                        <div class="block-item-overlay">
                            <div class="block-item-title">
                                <a href="{{ $article->permalink() }}">
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
                            <a class="read-more"
                               href="{{ $article->permalink() }}">
                                {{ __('Read More') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="block-item col-sm-6 col-lg-6">
                        <div class="block-item-img">
                            <a href="{{ $article->permalink() }}"
                               style="background-image: url('{{ $article->getMainImage('small') }}')"></a>
                            <div class="block-item-category"
                                 style="background-color: {{ $article->getMainCategory()->color }};">
                                <a href="{{ route('category.show', ['slug' => $article->getMainCategory()->slug, 'category' => $article->getMainCategory()->id]) }}">
                                    {{ $article->getMainCategory()->name }}
                                </a>
                            </div>
                        </div>
                        <div class="block-item-title">
                            <a href="{{ $article->permalink() }}">
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
                            {{ $article->getSummary(20) }}
                        </div>
                        <a class="read-more"
                           href="{{ $article->permalink() }}">
                            {{ __('Read More') }}
                        </a>
                    </div>
                @endif
                <?php $count++; ?>
            @endforeach
        </div>
        {{ $articles->appends(request()->except(['page']))->links() }}
    </div>
@endsection
