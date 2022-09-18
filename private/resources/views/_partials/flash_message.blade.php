<?php
$message = '';
$type = '';

if (session('message')) {
    $message = session('message');
    $type = 'primary';
}
if (session('success')) {
    $message = session('success');
    $type = 'success';
}

if (session('danger')) {
    $message = session('danger');
    $type = 'danger';
}

if (session('warning')) {
    $message = session('warning');
    $type = 'warning';
}

if (session('info')) {
    $message = session('info');
    $type = 'info';
}

if (isset($errors) && count($errors)) {
    $type = 'danger';
    $message = '<ul style="margin-bottom: 0; padding-left: 20px;">';
    foreach ($errors->all() as $error) {
        $message .= '<li>' . e($error) . '</li>';
    }
    $message .= '</ul>';
}
?>

@if($message)
    <div class="alert alert-{{ $type }}" role="alert">
        {!! $message !!}
    </div>
@endif
