<?php
/**
 * @var \App\User $user
 */
?>

{{ __('Hello') }},

{{ __('You have a new user registration') }}

<?= __('User Id') ?>: <?= $user->id ?>
<?= __('Username') ?>: <?= $user->username ?>
<?= __('Email') ?>: <?= $user->email ?>


{{ __('Thanks,') }}
{{ get_option('site_name') }}
