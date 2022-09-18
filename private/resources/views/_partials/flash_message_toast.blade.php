<?php

if (request()->route()->getPrefix()) {
    return;
}

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
    <div aria-live="polite" aria-atomic="true" class="position-fixed d-flex flex-column p-4"
         style="z-index: 2000; right: 0;">
        <div class="toast ml-auto alert-success" data-animation="true" data-autohide="true" data-delay="3000">
            <div class="toast-body p-0">
                <div class="alert alert-{{ $type }}" role="alert" style="margin: 0">
                    {!! $message !!}
                </div>
            </div>
        </div>
    </div>
@endif
