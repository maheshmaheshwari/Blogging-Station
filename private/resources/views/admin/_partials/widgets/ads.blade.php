<?php
$widget = array_merge([
    'title' => '',
    'ad_id' => '',
], $widget);
?>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Title') }}</label>
    <input type="text" name="item[{{ $widget['id'] }}][title]" class="form-control col-sm-10"
           value="{{ old('item['.$widget['id'].']title', $widget['title']) }}">
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Ads') }}</label>
    <select class="form-control col-sm-10" name="item[{{ $widget['id'] }}][ad_id]">
        @foreach($ads as $key=>$val)
            <option value="{{ $key }}" {{ (($key == $widget['ad_id'])? "selected":"") }}>{{$val}}</option>
        @endforeach
    </select>
</div>
