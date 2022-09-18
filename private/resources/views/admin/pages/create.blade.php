@extends('layouts.admin')

@section('title', e(__('Add Page')))

@section('content')

    <form action="{{ route('admin.pages.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-sm-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">{{ __('Add Page') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('title', __('Title')) }}
                            {{ Form::text('title', old('title'), ['class' => 'form-control', 'required' => true]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('slug', __('Slug(URL Key)')) }}
                            {{ Form::text('slug', old('slug'), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('content', __('Content')) }}
                            {{ Form::textarea('content', old('content'), ['class' => 'form-control text-editor']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('Page Settings') ?></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">{{ __('Choose') }}</option>
                                @foreach(get_page_statuses() as $key=>$val)
                                    <option value="{{ $key }}" {{ (($key === (int)old('status'))? "selected":"") }}>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection

@include('_partials.editor')
