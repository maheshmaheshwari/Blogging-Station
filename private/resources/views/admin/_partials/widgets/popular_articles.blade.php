<?php
$widget = array_merge([
    'title' => '',
    'auto' => '',
    'cats' => [],
    'tags' => [],
    'period' => '',
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
    <label class="col-sm-2 col-form-label">{{ __('Categories') }}</label>
    <select class="form-control col-sm-10" multiple name="item[{{ $widget['id'] }}][cats][]">
        @foreach($categories as $key=>$val)
            <option value="{{ $key }}" {{ ((in_array($key, $widget['cats']))? "selected":"") }}>{{$val}}</option>
        @endforeach
    </select>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Tags') }}</label>
    <select class="form-control col-sm-10" multiple name="item[{{ $widget['id'] }}][tags][]">
        @foreach($tags as $key=>$val)
            <option value="{{ $key }}" {{ ((in_array($key, $widget['tags']))? "selected":"") }}>{{$val}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>
        <input type="hidden" name="item[{{ $widget['id'] }}][auto]" value="0">
        <input type="checkbox" name="item[{{ $widget['id'] }}][auto]" value="1"
               @if($widget['auto'] == 1) checked @endif >
        {{ __('Auto detect current category or tag page') }}
    </label>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">{{ __('Period') }}</label>
    <select class="form-control col-sm-10" name="item[{{ $widget['id'] }}][period]">
        <option value="all" {{ (('all' == $widget['period'])? "selected":"") }}>{{ __('All time') }}</option>
        <option value="week" {{ (('week' == $widget['period'])? "selected":"") }}>{{ __('Last week') }}</option>
        <option value="month" {{ (('month' == $widget['period'])? "selected":"") }}>{{ __('Last month') }}</option>
        <option value="year" {{ (('year' == $widget['period'])? "selected":"") }}>{{ __('Last year') }}</option>
    </select>
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
