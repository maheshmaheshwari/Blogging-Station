@extends('layouts.install')

@section('title', e(__('Step 1: Database')))

@section('content')

    <form method="post" action="{{ route('install.database') }}">
        @csrf

        <div class="form-group">
            <label for="host">{{ __('Database Host URL') }}</label>
            <input type="text" class="form-control" id="host" name="host" value="{{ old('host', 'localhost') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="port">{{ __('Database Port') }}</label>
            <input type="number" class="form-control" id="port" name="port" value="{{ old('port', '3306') }}" required>
        </div>

        <div class="form-group">
            <label for="username">{{ __('Database Username') }}</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="password">{{ __('Database Username Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="database">{{ __('Database Name') }}</label>
            <input type="text" class="form-control" id="database" name="database" value="{{ old('database') }}"
                   required>
        </div>

        <button class="btn btn-primary" type="submit">{{ __('Next') }}</button>
    </form>

@endsection
