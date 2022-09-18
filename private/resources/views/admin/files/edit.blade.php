@extends('layouts.admin')

@section('title', e(__('File Edit')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('File Edit') }}
            <button class="btn btn-primary btn-sm float-right"
                    onclick="window.location.href='{{ route('admin.files.create') }}'">
                <i class="fas fa-upload"></i> {{ __('File Upload') }}
            </button>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.files.update', $file->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="file-url">{{ __('File URL') }}</label>
                    <input id="file-url" type="text" class="form-control input-sm" value='{{ url($file->file) }}'
                           readonly onfocus="this.select()">
                </div>

                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {{ Form::text('name', old('name', $file->name), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
                </div>
            </form>
        </div>
    </div>

@endsection
