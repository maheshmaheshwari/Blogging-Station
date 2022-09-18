@extends('layouts.admin')

@section('title', e(__('Referrals')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header"><i class="fa fa-exchange"></i> {{ __('Referrals') }}</div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped">
                <tr>
                    <th><?= __('Username'); ?></th>
                    <th><?= __('Referred By'); ?></th>
                    <th><?= __('Date'); ?></th>
                </tr>
                <!-- Here is where we loop through our $posts array, printing out post info -->
                @foreach ($referrals as $referral)
                    <tr>
                        <td>
                            <a href="{{ route('admin.users.edit', [$referral->id]) }}">{{ $referral->username }}</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.edit', [$referral->referred_by]) }}">{{ $referral->referred_by_username }}</a>
                        </td>
                        <td>{{ display_date_timezone($referral->created_at) }}</td>
                    </tr>
                @endforeach
            </table>

            <div class="table-responsive">
                {{ $referrals->appends(request()->except(['page']))->links() }}
            </div>

        </div>
    </div>

@endsection
