<?php
/**
 * @var \App\Withdraw $withdraw
 */
?>

<?= __('Hello') ?> <?= $withdraw->user->username ?>,

<?= __('Your withdrawal request #:id has been canceled.', ['id' => $withdraw->id]) ?>

<?= __('Thanks,') ?>
<?= e(get_option('site_name')) ?>
