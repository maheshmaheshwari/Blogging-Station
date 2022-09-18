@extends('layouts.admin')

@section('title', e(__('Pay Article')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Pay Article') }}</div>
        <div class="card-body">
            {!! Form::open([
                'route' => ['admin.articles.pay', $article->id],
                'method' => 'post'
            ]) !!}

            <p>{{ __('You are about to pay :price to author with username :username',
                ['price' => $article->price, 'username' => $article->user->username]) }}</p>

            <p>{{ __('The money will be added to the author earnings and he can withdraw it at anytime.') }}</p>

            <div class="form-group">
                {{ Form::submit(__('Pay'), ['class' => 'btn btn-lg btn-success']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
