<?php
/**
 * @var \App\Withdraw $withdraw
 */

$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');

$method = (isset($withdrawal_methods[$withdraw->method])) ?
    $withdrawal_methods[$withdraw->method] : $withdraw->method;

$amount = display_price_currency($withdraw->amount);
?>

<p><?= __('Hello') ?> <?= $withdraw->user->username ?>,</p>

<p><?= __('Your withdrawal request #:id has been approved for amount :amount and will be sent via :method',
        ['id' => $withdraw->id, 'amount' => $amount, 'method' => $method]) ?></p>

<p><?= __('Your request will be processed as part of our normal schedule. You will receive an email when your withdrawal has been processed.') ?>

<p>
    <?= __('Thanks,') ?><br>
    <?= e(get_option('site_name')) ?>
</p>
