@extends('layouts.install')

@section('title', e(__('Installation successful')))

@section('content')

    <div class="text-center">
        <a href="{{ url('') }}" class="btn btn-primary">{{ __('Access Home') }}</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-success">{{ __('Access Dashboard') }}</a>
    </div>

@endsection
