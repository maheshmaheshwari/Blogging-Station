@extends('layouts.install')

@section('title', e(__('Installation: Welcome')))

@section('content')

    <div class="alert alert-success">{{ __('Installation can continue as minimum requirements are met.') }}</div>

    <button class="btn btn-primary"
            onclick="window.location.href='{{ route('install.database') }}'">{{ __('Next') }}</button>

@endsection
