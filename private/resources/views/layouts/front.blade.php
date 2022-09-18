<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ get_option('language_direction', 'ltr') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', e(get_option('site_meta_title', get_option('site_name'))) )</title>
    <meta name="description" content="@yield('description', e(get_option('site_description')) )">
    <meta name="keywords" content="@yield('keywords', e(get_option('site_keywords')) )">
    <link rel="canonical" href="{{ url()->current() }}"/>

    <link rel="alternate" type="application/rss+xml" title="{{ get_option('site_name') }} {{ __('Feed') }}"
          href="{{ route('feed') }}"/>
    @if(request()->route()->getName() === 'category.show')
        <link href="{{ request()->route()->parameter('category')->feed() }}" rel="alternate" type="application/rss+xml"
              title="{{ __(':category-name Category Feed', ['category-name' => request()->route()->parameter('category')->name]) }}"/>
    @endif
    @if(request()->route()->getName() === 'tag.show')
        <link href="{{ request()->route()->parameter('tag')->feed() }}" rel="alternate" type="application/rss+xml"
              title="{{ __(':tag-name Tag Feed', ['tag-name' => request()->route()->parameter('tag')->name]) }}"/>
    @endif
    @if(request()->route()->getName() === 'author.show')
        <link href="{{ route('author.feed', ['username' => request()->route()->parameter('username')]) }}"
              rel="alternate" type="application/rss+xml"
              title="{{ __(':author Author Feed', ['author' => request()->route()->parameter('username')]) }}"/>
    @endif

    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='icon'/>
    <link href='{{ asset(get_style('favicon', '/favicon.ico')) }}' type='image/x-icon' rel='shortcut icon'/>

    @if(get_option('language_direction', 'ltr') === 'rtl')
        <link href="https://cdn.jsdelivr.net/gh/RTLCSS/bootstrap@4.2.1-rtl/dist/css/rtl/bootstrap.min.css"
              rel="stylesheet">
    @else
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.11.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selection-sharer@1.1.0/dist/selection-sharer.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,700|Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css?v=' . APP_VERSION) }}" rel="stylesheet">
    @if(get_option('language_direction', 'ltr') === 'rtl')
        <link href="{{ asset('assets/css/rtl.css?v=' . APP_VERSION) }}" rel="stylesheet">
    @endif

    @include('_partials.header_css')

    {!! get_option('frontend_head_code') !!}

    @stack('header')
</head>
<body class="{{ str_replace('.', '-', request()->route()->getName()) }} {{ get_option('language_direction', 'ltr') }} @stack('body_class')">

@include('_partials.flash_message_toast')

<div class="top-nav">
    <div class="container">
        <div class="wrap-inner">
            <div class="top-social">
                <ul class="list-inline">
                    @if(get_option('facebook_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('facebook_url') }}" class="fab fa-facebook-f fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('twitter_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('twitter_url') }}" class="fab fa-twitter fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('google_plus_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('google_plus_url') }}" class="fab fa-google fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('youtube_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('youtube_url') }}" class="fab fa-youtube fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('pinterest_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('pinterest_url') }}" class="fab fa-pinterest fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('instagram_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('instagram_url') }}" class="fab fa-instagram fa-fw"
                               target="_blank"></a></li>
                    @endif
                    @if(get_option('vk_url'))
                        <li class="list-inline-item">
                            <a href="{{ get_option('vk_url') }}" class="fab fa-vk fa-fw"
                               target="_blank"></a></li>
                    @endif
                </ul>
            </div>
            <div class="top-menu">
                {!! menu_display(get_style('top_menu'), [
                'ul_class' => 'list-inline',
                'li_class' => 'list-inline-item',
                'a_class' => '',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<div class="header">
    <div class="container">
        <div class="wrap-inner">
            <div class="logo">
                <a href="{{ url('/') }}">
                    @if(get_style('logo_image'))
                        <img src="{{ asset(get_style('logo_image')) }}" alt="{{ get_option('site_name') }}">
                    @else
                        {{ get_option('site_name') }}
                    @endif
                </a>
            </div>
            <div class="top-banner">
                <?= applyShortCodes('[ads id="' . get_style('header_ad') . '"]') ?>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light navbar-main sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            @if(get_style('logo_image'))
                <img src="{{ asset(get_style('logo_image')) }}" alt="{{ get_option('site_name') }}">
            @else
                {{ get_option('site_name') }}
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {!! menu_display(get_style('main_menu'), ['ul_class' => 'navbar-nav mr-auto','a_class'  => 'nav-link']) !!}

            <ul class="navbar-nav my-2 my-lg-0">
                <?php
                $write_paid_page = \App\Page::find(get_option('write_paid_page'));
                ?>
                @if($write_paid_page)
                    <li class="nav-item get-paid">
                        <a class="nav-link" href="{{ $write_paid_page->permalink() }}">
                            <i class="fas fa-pencil-alt"></i> {{ __('Write & Get Paid') }}
                        </a>
                    </li>
                @endif
                <li class="nav-item mini-search-menu-item">
                    <form method="get" action="{{ route('search') }}" class="d-flex justify-content-center">
                        <input name="q" class="form-control" type="search" required
                               placeholder="{{ __('Search keywords') }}" value="{{ request()->get('q', '') }}">
                        <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </li>
                <li class="nav-item search-menu-item">
                    <a class="nav-link" href="#"><i class="fas fa-search fa-fw"></i></a>
                    <div class="menu-search">
                        <form method="get" action="{{ route('search') }}" class="d-flex justify-content-center">
                            <input name="q" class="form-control" type="search" required
                                   placeholder="{{ __('Search keywords') }}" value="{{ request()->get('q', '') }}">
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer class="footer mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('footer1_sidebar') ) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('footer2_sidebar') ) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-inner">
                    {!! \App\Sidebar::sidebarDisplay( get_style('footer3_sidebar') ) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="separator"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col text-left">
                <div class="footer-menu">
                    {!! menu_display(get_style('footer_menu'), [
                    'ul_class' => 'list-inline mb-0',
                    'li_class' => 'list-inline-item',
                    'a_class' => '',
                    ]) !!}
                </div>
            </div>
            <div class="col text-right">
                {{ __('Copyright') }} &copy; {{ get_option('site_name') }} {{ date("Y") }}
            </div>
        </div>
    </div>
</footer>

@include('_partials.js_vars')

<script data-cfasync="false" src="{{ asset('assets/js/ads.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/selection-sharer@1.1.0/dist/selection-sharer.js"></script>
<script src="https://cdn.jsdelivr.net/gh/ppowalowski/stickUp2@2.3.2/build/js/stickUp.min.js"></script>

<script src="{{ asset('assets/js/app.js?v=' . APP_VERSION) }}"></script>

{!! get_option('frontend_footer_code') !!}

@stack('footer')

</body>
</html>
