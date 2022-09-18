@extends('layouts.admin')

@section('title', e(__('Database Upgrade')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <i class="fas fa-database"></i> {{ __('Database Upgrade') }}
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.upgrade.process') }}"
                  onSubmit="run_upgrade.disabled=true; run_upgrade.innerHTML='{{ __('Upgrading ...') }}'; return true;">
                @csrf

                <div class="form-group">
                    <button name="run_upgrade" type="submit" class="btn btn-danger btn-lg">
                        {{ __('Database Upgrade') }}</button>
                </div>
            </form>

        </div>
    </div>

@endsection
