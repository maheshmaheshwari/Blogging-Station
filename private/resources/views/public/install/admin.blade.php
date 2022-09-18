@extends('layouts.install')

@section('title', e(__('Step 3: Create Admin User')))

@section('content')

    <form method="post" action="{{ route('install.admin') }}">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('Email') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="username">{{ __('Username') }}</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
            <label for="password">{{ __('Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                   value="{{ old('password_confirmation') }}"
                   required>
        </div>

        <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
    </form>

@endsection
