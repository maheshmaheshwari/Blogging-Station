@extends('layouts.admin')

@section('title', e(__('Edit Category')))

@section('content')

    {!! Form::open([
        'route' => ['admin.categories.update', $category->id],
        'files' => true,
        //'novalidate' => 'novalidate',
        'method' => 'put'
    ]) !!}

    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Edit Category') }}</div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('parent_id', __('Parent Category')) }}
                {{ Form::select('parent_id', $categories, old('parent_id', $category->parent_id),
                    ['class' => 'form-control', 'placeholder' => __('Parent Category')]) }}
            </div>

            <div class="form-group">
                {{ Form::label('name', __('Name')) }}
                {{ Form::text('name', old('name', $category->name), ['class' => 'form-control', 'required' => true]) }}
            </div>

            <div class="form-group">
                {{ Form::label('slug', __('Slug(URL Key)')) }}
                {{ Form::text('slug', old('slug', $category->slug), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('status', 'Status') }}
                {{ Form::select('status', [
                    0 => __('Inactive'),
                    1 => __('Active'),
                ], old('status', $category->status), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
            </div>

            <div class="form-group">
                {{ Form::label('description', __('Description')) }}
                {{ Form::textarea('description', old('description', $category->description), ['class' => 'form-control', 'rows' => 3]) }}
            </div>

            <div class="form-group">
                {{ Form::label('color', __('Primary Color')) }}
                {{ Form::text('color', old('color', $category->color), ['class' => 'form-control color-select']) }}
            </div>

            <div class="form-group">
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header"><?= __('SEO ') ?></div>
        <div class="card-body">
            <div class="form-group">
                {{ Form::label('seo[title]', __('SEO Title')) }}
                {{ Form::text('seo[title]', old('seo[title]', $category->seo['title']), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('seo[keywords]', __('SEO Keywords')) }}
                {{ Form::text('seo[keywords]', old('seo[keywords]', $category->seo['keywords']), ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('seo[description]', __('SEO Description')) }}
                {{ Form::textarea('seo[description]', old('seo[description]', $category->seo['description']), ['class' => 'form-control', 'rows' => 3]) }}
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
