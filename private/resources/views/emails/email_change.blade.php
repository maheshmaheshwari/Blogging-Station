<?php
/**
 * @var \App\User $user
 */
?>

<p>{{ __('Hello') }},</p>

<p>{{ __('To change your email click on the following link or copy-paste it in your browser:') }}</p>

<p>
    <a href="{{ route('member.email.change.process', [$user->username, $user->activation_key]) }}">
        {{ route('member.email.change.process', [$user->username, $user->activation_key]) }}
    </a>
</p>

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
