<?php
/**
 * @var \App\User $user
 */
?>
@extends('layouts.front')

@section('title', e($user->name))
@section('description', e($user->getMetaDescription()))

@section('content')
    <main role="main" class="container">

        <div class="row">
            <div class="col-lg-8">
                <div class="col-inner">

                    <div class="author-details">
                        <div class="author-info">
                            <div class="author-image">
                                <img alt="{{ $user->name }}" height="150" width="150" src="{{ $user->profileImage() }}">
                            </div>
                            <div class="author-connect">
                                <h1 class="author-name">
                                    {{ $user->name }}
                                </h1>
                                <div class="follow-me">
                                    @if($user->socialNetwork('facebook'))
                                        <a href="{{ $user->socialNetwork('facebook') }}" target="_blank"
                                           class="fab fa-facebook-f fa-fw"></a>
                                    @endif

                                    @if($user->socialNetwork('twitter'))
                                        <a href="{{ $user->socialNetwork('twitter') }}" target="_blank"
                                           class="fab fa-twitter fa-fw"></a>
                                    @endif

                                    @if($user->socialNetwork('linkedin'))
                                        <a href="{{ $user->socialNetwork('linkedin') }}" target="_blank"
                                           class="fab fa-linkedin-in fa-fw"></a>
                                    @endif

                                    @if($user->socialNetwork('youtube'))
                                        <a href="{{ $user->socialNetwork('youtube') }}" target="_blank"
                                           class="fab fa-youtube fa-fw"></a>
                                    @endif
                                    @if($user->socialNetwork('vimeo'))
                                        <a href="{{ $user->socialNetwork('vimeo') }}" target="_blank"
                                           class="fab fa-vimeo-v fa-fw"></a>
                                    @endif
                                    @if($user->socialNetwork('instagram'))
                                        <a href="{{ $user->socialNetwork('instagram') }}" target="_blank"
                                           class="fab fa-instagram fa-fw"></a>
                                    @endif
                                    @if($user->socialNetwork('pinterest'))
                                        <a href="{{ $user->socialNetwork('pinterest') }}" target="_blank"
                                           class="fab fa-pinterest-p fa-fw"></a>
                                    @endif
                                    @if($user->socialNetwork('vk'))
                                        <a href="{{ $user->socialNetwork('vk') }}" target="_blank"
                                           class="fab fa-vk fa-fw"></a>
                                    @endif
                                    @if($user->socialNetwork('github'))
                                        <a href="{{ $user->socialNetwork('github') }}" target="_blank"
                                           class="fab fa-github fa-fw"></a>
                                    @endif
                                </div>

                                <div class="author-description">
                                    {{ $user->description }}
                                </div>

                                <div class="author-follow">
                                    @if(!auth()->check() || !$user->followers()->wherePivot('follower_id', auth()->user()->id)->exists())
                                        <form method="post" action="{{ route('author.follow', [$user->username]) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-primary btn-sm btn-follow"
                                                   value="{{ __('Follow') }}">
                                        </form>
                                    @else
                                        <form method="post" action="{{ route('author.unfollow', [$user->username]) }}">
                                            @csrf
                                            <input type="submit" class="btn btn-primary btn-sm btn-follow"
                                                   value="{{ __('Unfollow') }}">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row main-listing">
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
                                            <small><i class="far fa-eye"></i> {{ display_number($article->hits) }} {{ __('Hits') }}</small>
                                            -
                                            <small>
                                                <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                                            </small>
                                            -
                                            <small><i class="far fa-user"></i> {{ $article->user->name }}
                                            </small>
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

                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('author_sidebar') ) !!}
                </div>
            </div>
        </div>

    </main><!-- /.container -->
@endsection
