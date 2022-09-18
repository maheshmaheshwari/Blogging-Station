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

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][title]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']title', $widget['title']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Facebook') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][facebook]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']facebook', $widget['facebook']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Twitter') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][twitter]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']twitter', $widget['twitter']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Google+') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][google_plus]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']google_plus', $widget['google_plus']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('YouTube') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][youtube]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']youtube', $widget['youtube']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Pinterest') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][pinterest]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']pinterest', $widget['pinterest']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Instagram') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][instagram]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']instagram', $widget['instagram']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('VK') }}</label>
    <input type="url" name="item[{{ $widget['id'] }}][vk]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']vk', $widget['vk']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('CSS Class') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][class]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']class', $widget['class']) }}">
</div>
