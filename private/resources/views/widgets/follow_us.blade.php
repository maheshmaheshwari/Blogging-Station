<?php
$widget = array_merge([
    'title' => '',
    'facebook' => '',
    'twitter' => '',
    'google_plus' => '',
    'youtube' => '',
    'pinterest' => '',
    'instagram' => '',
    'vk' => '',
    'class' => '',
], $widget);
?>

<div class="widget follow-us {{ $widget['class'] }}">
    <div class="block-header">
        <div class="block-title"><span>{{ $widget['title'] }}</span></div>
    </div>
    <div class="block-content">
        @if($widget['facebook'])
            <a href="{{ $widget['facebook'] }}" target="_blank" class="fab fa-facebook-f fa-fw"></a>
        @endif

        @if($widget['twitter'])
            <a href="{{ $widget['twitter'] }}" target="_blank" class="fab fa-twitter fa-fw"></a>
        @endif

        @if($widget['google_plus'])
            <a href="{{ $widget['google_plus'] }}" target="_blank" class="fab fa-google fa-fw"></a>
        @endif

        @if($widget['youtube'])
            <a href="{{ $widget['youtube'] }}" target="_blank" class="fab fa-youtube fa-fw"></a>
        @endif

        @if($widget['pinterest'])
            <a href="{{ $widget['pinterest'] }}" target="_blank" class="fab fa-pinterest-p fa-fw"></a>
        @endif

        @if($widget['instagram'])
            <a href="{{ $widget['instagram'] }}" target="_blank" class="fab fa-instagram fa-fw"></a>
        @endif

        @if($widget['vk'])
            <a href="{{ $widget['vk'] }}" target="_blank" class="fab fa-vk fa-fw"></a>
        @endif
    </div>
</div>
