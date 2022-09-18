@extends('layouts.admin')

@section('title', e(__('License Activation')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0"><i class="fas fa-shield-alt"></i> {{ __('License Activation') }}</h5>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.activation.process') }}"
                  onSubmit="activation.disabled=true; activation.innerHTML='{{ __('Submitting ...') }}'; return true;">
                @csrf

                <div class="form-group">
                    <label for="personal_token">{{ __('Personal Token') }}</label>
                    <input type="text" name="personal_token" id="personal_token" class="form-control"
                           value="{{ old('personal_token', get_option('personal_token')) }}" required>
                    <small class="form-text text-muted">{!! __('Click <a href=":url" target="_blank">here</a> to learn how to generate a personal token.', ['url' => 'https://mightyscripts.freshdesk.com/support/solutions/articles/5000708895-how-to-generate-a-personal-token-'])  !!}</small>
                </div>

                <div class="form-group">
                    <label for="purchase_code">{{ __('Purchase Code') }}</label>
                    <input type="text" name="purchase_code" id="purchase_code" class="form-control"
                           value="{{ old('purchase_code', get_option('purchase_code')) }}" required>
                    <small class="form-text text-muted">{!! __('Click <a href=":url" target="_blank">here</a> to learn how to get your purchase code.', ['url' => 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-'])  !!}</small>
                </div>

                <div class="form-group">
                    <button name="activation" type="submit" class="btn btn-danger">{{ __('Submit') }}</button>
                </div>
            </form>

        </div>
    </div>

@endsection
