@extends('layouts.member')

@section('title', e(__('Set Username')))

@section('content')

    <h4>{{ __('Set Username') }}</h4>

    <form action="{{ route('member.set.username') }}" method="post">
        @csrf

        <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">{{ __('Username') }}</label>

            <div class="col-sm-9">
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                       class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" required>
                @if ($errors->has('username'))
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
        </div>

    </form>

@endsection
