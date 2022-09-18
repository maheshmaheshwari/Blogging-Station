<?php
$widget = array_merge([
    'title' => '',
    'class' => '',
], $widget);
?>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][title]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']title', $widget['title']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('CSS Class') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][class]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']class', $widget['class']) }}">
</div>
