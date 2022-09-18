<?php
/**
 * @var \App\User $user
 */
?>

{{ __('Hello') }},

{{ __('To change your email click on the following link or copy-paste it in your browser:') }}

{{ route('member.email.change.process', [$user->username, $user->activation_key]) }}

{{ __('Thanks,') }}
{{ get_option('site_name') }}
