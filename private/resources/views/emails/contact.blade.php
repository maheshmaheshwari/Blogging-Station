<p><?= __('Name') ?>: <b>{{ $name }}</b></p>
<p><?= __('Email') ?>: <b>{{ $email }}</b></p>
<p><?= __('Message') ?>:<br>
    <?= nl2br(e($body)); ?>
</p>
