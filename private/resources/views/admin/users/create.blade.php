@extends('layouts.admin')

@section('title', e(__('Add User')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header"><i class="fa fa-user"></i> {{ __('Add User') }}</div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="form-group">
                    {{ Form::label('role', 'Role') }}
                    {{ Form::select('role', [
                        'admin' => __('Admin'),
                        'member' => __('member'),
                    ], old('role'), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', get_user_statuses(), old('status'), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('username', __('Username')) }}
                    {{ Form::text('username', old('username'), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', __('Email')) }}
                    {{ Form::email('email', old('email'), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', __('Password')) }}
                    {{ Form::password('password', ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                </div>

            </form>
        </div>
    </div>

@endsection
