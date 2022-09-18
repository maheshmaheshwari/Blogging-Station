@extends('layouts.member')

@section('title', e(__('Referrals')))

@section('content')
    <p>
        {{ __('The referral program is a great way to spread the word of this great service and to earn even more money with your articles! Refer friends and receive :referral_percentage% of their earnings for life!', ['referral_percentage' => get_option('referral_percentage', '20')]) }}
    </p>

    <strong>{{ __('Your Referral URL') }}</strong>: <code>{{ route('referral.url', [user()->username]) }}</code>

    <div class="card mt-3">
        <div class="card-header">
            <i class="fas fa-exchange-alt"></i> <?= __('My Referrals') ?>
        </div>
        <div class="card-body p-0">

            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('Username'); ?></th>
                    <th><?= __('Date'); ?></th>
                </tr>
                </thead>
                @foreach ($referrals as $referral)
                    <tr>
                        <td>{{ $referral->username }}</td>
                        <td>{{ display_date_timezone($referral->created_at) }}</td>
                    </tr>
                @endforeach
            </table>

            {{ $referrals->appends(request()->except(['page']))->links() }}

        </div><!-- /.box-body -->
    </div>
@endsection
