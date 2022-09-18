<?php
/**
 * @var \App\User $user
 */
?>

<p>{{ __('Hello') }},</p>

<p>{{ __('Thank you for registering at :site_name. Your account is created and must be activated before you can use it.',
        ['site_name' => get_option('site_name')]) }}</p>

<p>{{ __('To activate the account click on the following link or copy-paste it in your browser:') }}</p>

<p>
    <a href="{{ route('email.verify', [$user->username, $user->activation_key]) }}">
        {{ route('email.verify', [$user->username, $user->activation_key]) }}
    </a>
</p>

<p>
    {{ __('Thanks,') }}<br>
    {{ get_option('site_name') }}
</p>
