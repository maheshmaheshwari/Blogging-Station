<?php
/**
 * @var \App\User $user
 */
?>

{{ __('Hello') }},

{{ __('Thank you for registering at :site_name. Your account is created and must be activated before you can use it.',
        ['site_name' => get_option('site_name')]) }}

{{ __('To activate the account click on the following link or copy-paste it in your browser:') }}

{{ route('email.verify', [$user->username, $user->activation_key]) }}

{{ __('Thanks,') }}
{{ get_option('site_name') }}
