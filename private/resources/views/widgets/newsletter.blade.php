<?php
$widget = array_merge([
    'title' => '',
    'class' => '',
], $widget);
?>

<div class="widget newsletter {{ $widget['class'] }}">
    <div class="block-header">
        <div class="block-title"><span>{{ $widget['title'] }}</span></div>
    </div>
    <div class="block-content">
        <p>{{ __('Subscribe our newsletter to stay updated.') }}</p>

        <form method="post" action="{{ route('newsletter.subscribe') }}" class="newsletter-subscribe">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="mail@example.com" class="form-control" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="{{ __('Subscribe') }}">
            </div>
        </form>
    </div>
</div>
