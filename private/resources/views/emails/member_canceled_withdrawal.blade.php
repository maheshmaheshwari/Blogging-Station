<?php
/**
 * @var \App\Withdraw $withdraw
 */
?>

<p><?= __('Hello') ?> <?= $withdraw->user->username ?>,</p>

<p><?= __('Your withdrawal request #:id has been canceled.', ['id' => $withdraw->id]) ?></p>

<p>
    <?= __('Thanks,') ?><br>
    <?= e(get_option('site_name')) ?>
</p>
