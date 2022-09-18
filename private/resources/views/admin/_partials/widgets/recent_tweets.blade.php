<?php
$widget = array_merge([
    'title' => '',
    'username' => '',
    'twitter_api_key' => '',
    'twitter_api_secret_key' => '',
    'num' => 5,
    'class' => '',
], $widget);
?>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][title]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']title', $widget['title']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Username') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][username]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']username', $widget['username']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Twitter API Key') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][twitter_api_key]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']twitter_api_key', $widget['twitter_api_key']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Twitter API secret key') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][twitter_api_secret_key]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']twitter_api_secret_key', $widget['twitter_api_secret_key']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Number') }}</label>
    <input type="number" min="1" step="1" name="item[{{ $widget['id'] }}][num]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']num', $widget['num']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('CSS Class') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][class]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']class', $widget['class']) }}">
</div>
