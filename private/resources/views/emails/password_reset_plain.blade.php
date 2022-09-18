<?php
/**
 * @var \App\User $user
 */
?>

{{ __('Hello') }},

{{ __('Someone requested that the password be reset for the following account:') }}

{{ url('/') }}

{{ __('If this was a mistake, just ignore this email and nothing will happen.') }}

{{ __('To reset your password click on the following link or copy-paste it in your browser:') }}

{{ route('password.reset', [$user->username, $user->activation_key]) }}

{{ __('Thanks,') }}
{{ get_option('site_name') }}
