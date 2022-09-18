@extends('layouts.auth')

@section('title', e(__('Login')))
@section('description', e(__('Login to start your session')))

@section('content')

    <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf

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

        @if ((bool)get_option('captcha_login', 0) && isset_captcha())
            <div class="form-group captcha">
                <div id="captchaLogin" style="display: inline-block;"></div>
            </div>
        @endif

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block btn-sm">
                {{ __('Login') }}
            </button>
        </div>

        <a href="{{ route('password.reset') }}">{{ __('I forgot my password') }}</a>
        <br>
        <a href="{{ route('register') }}">{{ __('Register a new membership') }}</a>
    </form>

    <hr>

    @if ((bool)get_option('social_login_facebook', false))
        <a href="{{ route('social.login', ['facebook', 'action' => 'login']) }}" class="sb sb-facebook btn-block">
            {{ __('Login with Facebook') }}
        </a>
    @endif

    @if ((bool)get_option('social_login_twitter', false))
        <a href="{{ route('social.login', ['twitter', 'action' => 'login']) }}" class="sb sb-twitter btn-block">
            {{ __('Login with Twitter') }}
        </a>
    @endif

    @if ((bool)get_option('social_login_google', false))
        <a href="{{ route('social.login', ['google', 'action' => 'login']) }}" class="sb sb-google btn-block">
            {{ __('Login with Google') }}
        </a>
    @endif
@endsection
