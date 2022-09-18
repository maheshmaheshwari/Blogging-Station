<?php
/**
 * @var \App\Withdraw $withdraw
 */

$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');
?>

<p><?= __('Hello') ?>,</p>

<p><?= __('A new withdraw has been requested with the following details:') ?></p>

<p><?= __('Withdraw Id') ?>: <?= $withdraw->id ?></p>
<p><?= __('Username') ?>: <?= $withdraw->user->username ?></p>
<p><?= __('Publisher Earnings') ?>: <?= display_price_currency($withdraw->author_earnings); ?></p>
<p><?= __('Referral Earnings') ?>: <?= display_price_currency($withdraw->referral_earnings); ?></p>
<p><?= __('Total Amount') ?>: <?= display_price_currency($withdraw->amount); ?></p>
<p><?= __('Method') ?>: <?= $withdrawal_methods[$withdraw->method] ?? $withdraw->method ?></p>
<p><?= __('Account') ?>: <?= nl2br(e($withdraw->account)) ?></p>

<p>
    <?= __('Thanks,') ?><br>
    <?= e(get_option('site_name')) ?>
</p>
