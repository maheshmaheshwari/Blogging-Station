@extends('layouts.admin')

@section('title', e(__('Payout Rates')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">
                <i class="nav-icon fas fa-dollar-sign"></i> {{ __('Payout Rates') }}
            </h5>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.prices') }}" enctype="multipart/form-data" id="form-settings"
                  onsubmit="save_settings.disabled=true; save_settings.innerHTML='{{ __('Saving ...') }}'; return true;">
                @csrf

                <div class="row">
                    @foreach (get_countries(true) as $country => $value)
                        <div class="form-group col-sm-6 row">
                            <div class="col-6">{{ $value }}</div>
                            <div class="col-6">
                                {{ Form::text("prices[{$country}][1]", old("prices[{$country}][1]", $prices->value[$country][1]),
                                    ['class' => 'form-control']) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    {{ Form::submit(__('Save'), ['name' => 'save_settings', 'class' => 'btn btn-primary']) }}
                </div>

            </form>
        </div>
    </div>

@endsection
