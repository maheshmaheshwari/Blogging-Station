<?php
/**
 * @var \App\Page $page
 */
?>
@extends('layouts.front')

@section('title', e($page->title))
@section('description', e($page->getMetaDescription()))

@section('content')
    <main role="main" class="container">

        <h1 class="page-title">{{ $page->title }}</h1>

        <div class="page-content">
            {!! $page->content !!}
        </div>

    </main><!-- /.container -->
@endsection
