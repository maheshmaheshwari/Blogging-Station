@extends('layouts.admin')

@section('title', e(__('Edit Category')))

@section('content')

    <form method="post" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="card card-primary card-outline">
            <div class="card-header">{{ __('Add New Category') }}</div>
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('parent_id', __('Parent Category')) }}
                    {{ Form::select('parent_id', $all_categories, old('parent_id'),
                        ['class' => 'form-control', 'placeholder' => __('Parent Category')]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {{ Form::text('name', old('name'), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('slug', __('Slug(URL Key)')) }}
                    {{ Form::text('slug', old('slug'), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', [
                        0 => __('Inactive'),
                        1 => __('Active'),
                    ], old('status', 1), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', __('Description')) }}
                    {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 3]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('color', __('Primary Color')) }}
                    {{ Form::text('color', old('color'), ['class' => 'form-control color-select']) }}
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
                    {{ Form::text('seo[title]', old('seo[title]'), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo[keywords]', __('SEO Keywords')) }}
                    {{ Form::text('seo[keywords]', old('seo[keywords]'), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('seo[description]', __('SEO Description')) }}
                    {{ Form::textarea('seo[description]', old('seo[description]'), ['class' => 'form-control', 'rows' => 3]) }}
                </div>
            </div>
        </div>

    </form>
@endsection
