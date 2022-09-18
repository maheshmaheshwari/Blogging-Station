@extends('layouts.admin')

@section('title', e(__('Edit User')))

@section('content')

    <?php
    $yes_no = [
        1 => __('Yes'),
        0 => __('No'),
    ];
    ?>
    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Edit User') }}</div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.users.update', [$user->id]) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    {{ Form::label('role', 'Role') }}
                    {{ Form::select('role', [
                        'admin' => __('Admin'),
                        'member' => __('member'),
                    ], old('role', $user->role), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', get_user_statuses(), old('status', $user->status), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('disable_earnings', 'Disable User Future Earnings') }}
                    {{ Form::select('disable_earnings', $yes_no, old('disable_earnings', $user->disable_earnings), ['placeholder' => __('Choose'), 'class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('username', __('Username')) }}
                    {{ Form::text('username', old('username', $user->username), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', __('Email')) }}
                    {{ Form::email('email', old('email', $user->email), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    {{ Form::label('password', __('Password')) }}
                    {{ Form::password('password', ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {{ Form::text('name', old('name', $user->name), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('description', __('Biography')) }}
                    {{ Form::textarea('description', old('description', $user->description), ['class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('author_earnings', __('Author Earnings')) }}
                    {{ Form::number('author_earnings', old('author_earnings', $user->author_earnings), ['class' => 'form-control', 'min' => 0, 'step' => 'any']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('referral_earnings', __('Referral Earnings')) }}
                    {{ Form::number('referral_earnings', old('referral_earnings', $user->referral_earnings), ['class' => 'form-control', 'min' => 0, 'step' => 'any']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                </div>
            </form>
        </div>
    </div>

@endsection
