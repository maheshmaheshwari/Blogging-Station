@extends('layouts.install')

@section('title', e(__('Step 2: Build database')))

@section('content')

    <p>{{ __('Create tables and load initial data') }}</p>

    <a class="btn btn-primary" href="{{ route('install.data', ['run' => 1]) }}"
       onclick="buildOnClick(this);">{{ __('Build database') }}</a>

    <script>
        function buildOnClick(element) {
            setTimeout(function () {
                element.href = 'javascript: void(0);';
                element.text = '{{ __('Building ...') }}';
                element.classList.add('disabled')
            }, 1);
        }
    </script>

@endsection
