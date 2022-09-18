<?php
/**
 * @var \App\Withdraw $withdraw
 */

$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');
?>

<?= __('Hello') ?>,

<?= __('A new withdraw has been requested with the following details:') ?>

<?= __('Withdraw Id') ?>: <?= $withdraw->id ?>
<?= __('Username') ?>: <?= $withdraw->user->username ?>
<?= __('Publisher Earnings') ?>: <?= display_price_currency($withdraw->author_earnings); ?>
<?= __('Referral Earnings') ?>: <?= display_price_currency($withdraw->referral_earnings); ?>
<?= __('Total Amount') ?>: <?= display_price_currency($withdraw->amount); ?>
<?= __('Method') ?>: <?= $withdrawal_methods[$withdraw->method] ?? $withdraw->method ?>
<?= __('Account') ?>: <?= nl2br(e($withdraw->account)) ?>


<?= __('Thanks,') ?><br>
<?= e(get_option('site_name')) ?>
