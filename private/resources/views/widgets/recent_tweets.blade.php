<?php
$widget = array_merge([
    'title' => '',
    'username' => '',
    'twitter_api_key' => '',
    'twitter_api_secret_key' => '',
    'num' => 5,
    'class' => '',
], $widget);

if (!$widget['twitter_api_key'] || !$widget['twitter_api_secret_key']) {
    echo __('Make sure to add Twitter API key and API secret key from the widget settings');
    return;
}

$tweets = \Cache::remember('recent_tweets_' . $widget['id'], 3 * 60 * 60, function () use ($widget) {
    $result = curlRequest('https://api.twitter.com/oauth2/token',
        'POST', ['grant_type' => 'client_credentials'], [
            'Authorization: Basic ' . base64_encode($widget['twitter_api_key'] . ':' . $widget['twitter_api_secret_key'])
        ]);

    /*
    if (!empty($result->error)) {
        exit($result->error);
    }

    if (isset(json_decode($result->body)->errors)) {
        exit(json_decode($result->body)->errors[0]->message);
    }
    */

    $result = curlRequest('https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=' . $widget['username'] . '&count=' . $widget['num'],
        'GET', [], [
            'Authorization: Bearer ' . json_decode($result->body)->access_token
        ]);

    return json_decode($result->body);
});
?>
<div class="widget tweets {{ $widget['class'] }}">
    <div class="block-header">
        <div class="block-title"><span>{{ $widget['title'] }}</span></div>
    </div>
    <div class="block-content">
        @foreach($tweets as $tweet)
            <div class="block-item">
                <div class="block-content">
                    <i class="fab fa-twitter" style="color: #55ACEE;"></i> {{ $tweet->text }}
                </div>
                <div class="block-item-meta">
                    <small>
                        <a href="https://twitter.com/i/web/status/{{ $tweet->id_str }}" target="_blank">
                            <i class="far fa-clock"></i> {{ display_date_timezone($tweet->created_at) }}
                        </a>
                    </small>
                </div>
            </div>
        @endforeach
    </div>
</div>
