<?php
/**
 * @var \App\Withdraw $withdraw
 */

$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');

$method = (isset($withdrawal_methods[$withdraw->method])) ?
    $withdrawal_methods[$withdraw->method] : $withdraw->method;

$amount = display_price_currency($withdraw->amount);
?>

<?= __('Hello') ?> <?= $withdraw->user->username ?>,

<?= __('We just processed your withdraw request #:id for :amount via :method',
    ['id' => $withdraw->id, 'amount' => $amount, 'method' => $method]) ?>

<?= __('Happy Spending!') ?>

<?= __('Thanks,') ?>
<?= e(get_option('site_name')) ?>
