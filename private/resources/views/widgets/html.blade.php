<?php
$widget = array_merge([
    'title' => '',
    'code' => '',
    'class' => '',
], $widget);
?>

<div class="widget newsletter {{ $widget['class'] }}">
    <div class="block-header">
        <div class="block-title"><span>{{ $widget['title'] }}</span></div>
    </div>
    <div class="block-content">
        {!! $widget['code'] !!}
    </div>
</div>
