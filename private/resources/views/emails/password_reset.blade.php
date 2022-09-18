<?php
/**
 * @var \App\User $user
 */
?>

<p>{{ __('Hello') }},</p>

<p>{{ __('Someone requested that the password be reset for the following account:') }}</p>

<p>{{ url('/') }}</p>

<p>{{ __('If this was a mistake, just ignore this email and nothing will happen.') }}</p>

<p>{{ __('To reset your password click on the following link or copy-paste it in your browser:') }}</p>

<p>
    <a href="{{ route('password.reset', [$user->username, $user->activation_key]) }}">
        {{ route('password.reset', [$user->username, $user->activation_key]) }}
    </a>
</p>

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
