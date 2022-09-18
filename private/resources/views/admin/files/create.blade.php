@extends('layouts.admin')

@section('title', e(__('File Upload')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header"><i class="fas fa-upload"></i> {{ __('File Upload') }}</div>
        <div class="card-body">
            <form action="{{ route('admin.files.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file">{{ __('File Select') }}</label>
                    {{ Form::file('file') }}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
                </div>
            </form>
        </div>
    </div>

@endsection
