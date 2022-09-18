@extends('layouts.auth')

@section('title', e(__('Forgot Password')))
@section('description', e(__('Enter your e-mail address below to reset your password.')))

@section('content')

    @if (!$username && !$key)

        <form id="forgot-password-form" method="POST" action="{{ route('password.reset') }}">
            @csrf

            <div class="form-group">
                <input id="email" type="email"
                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                       name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                @endif
            </div>

            @if ((bool)get_option('captcha_forgot_password', 0) && isset_captcha())
                <div class="form-group captcha">
                    <div id="captchaForgotPassword" style="display: inline-block;"></div>
                </div>
            @endif

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-sm">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>

    @else

        <form method="POST" action="{{ route('password.reset', [$username, $key]) }}">
            @csrf

            <div class="form-group">
                <input id="password" type="password"
                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                       name="password" placeholder="{{ __('New Password') }}" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                @endif
            </div>

            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-sm">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>

    @endif

@endsection
