@extends('layouts.auth')

@section('title', e(__('Register')))
@section('description', e(__('Register a new membership')))

@section('content')

    <form id="register-form" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <input id="name" type="text"
                   class="form-control form-control-sm{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <input id="username" type="text"
                   class="form-control form-control-sm{{ $errors->has('username') ? ' is-invalid' : '' }}"
                   name="username" value="{{ old('username') }}" placeholder="{{ __('Username') }}" required>

            @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('username') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <input id="email" type="email"
                   class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}"
                   name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <input id="password" type="password"
                   class="form-control form-control-sm{{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" placeholder="{{ __('Password') }}" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control form-control-sm"
                   name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
        </div>

        @if ((bool)get_option('captcha_register', 0) && isset_captcha())
            <div class="form-group captcha">
                <div id="captchaRegister" style="display: inline-block;"></div>
            </div>
        @endif

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-sm">
                {{ __('Register') }}
            </button>
        </div>
    </form>

    <a href="{{ route('login') }}">{{ __('I already have a membership') }}</a>

    <hr>

    @if ((bool)get_option('social_login_facebook', false))
        <a href="{{ route('social.login', ['provider '=> 'facebook', 'action' => 'register']) }}"
           class="sb sb-facebook btn-block">
            {{ __('Register with Facebook') }}
        </a>
    @endif

    @if ((bool)get_option('social_login_twitter', false))
        <a href="{{ route('social.login', ['twitter', 'action' => 'register']) }}" class="sb sb-twitter btn-block">
            {{ __('Register with Twitter') }}
        </a>
    @endif

    @if ((bool)get_option('social_login_google', false))
        <a href="{{ route('social.login', ['google', 'action' => 'register']) }}" class="sb sb-google btn-block">
            {{ __('Register with Google') }}
        </a>
    @endif
@endsection
