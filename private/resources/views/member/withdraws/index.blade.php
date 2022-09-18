@extends('layouts.member')

@section('title', e(__('Withdraws')))

@section('content')
    <?php
    $withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');
    ?>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ display_price_currency(user()->author_earnings + user()->referral_earnings) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Available Balance') }}</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ display_price_currency($pending_withdrawn) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Pending Withdrawn') }}</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ display_price_currency($total_withdrawn) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Total Withdrawn') }}</div>
            </div>
        </div>
    </div>

    <p>
        {{ __("When your account reaches the minimum amount or more, you may request your earnings by clicking the below button. The payment is then sent to your withdraw account during business days.") }}
    </p>

    <p>
        {!! __("In order to receive your payments you need to fill your withdraw method and account :settings_url if you haven't done so.", ['settings_url' => '<a href="'.route('member.settings').'">' .__('here'). '</a>']) !!}
    </p>

    <hr>

    <div class="text-center">
        <form method="post" action="{{ route('member.withdraws.request') }}"
              onsubmit="return confirm('{{ __('Are you sure?') }}');">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">{{ __('Withdraw') }}</button>
        </form>
    </div>

    <hr>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>{{ __('Id') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{  __('Author Earnings') }}</th>
                    @if ((bool)get_option('enable_referrals', 1))
                        <th>{{ __('Referral Earnings') }}</th>
                    @endif
                    <th>{{ __('Total Amount') }}</th>
                    <th>{{ __('Withdrawal Method') }}</th>
                    <th>{{ __('Withdrawal Account') }}</th>
                </tr>
                </thead>

                <!-- Here is where we loop through our $posts array, printing out post info -->

                @foreach ($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->id }}</td>
                        <td>{{ $withdraw->created_at }}</td>
                        <td>{{ get_withdraw_statuses($withdraw->status) }}</td>
                        <td>{{ display_price_currency($withdraw->author_earnings) }}</td>
                        @if ((bool)get_option('enable_referrals', 1))
                            <td>{{ display_price_currency($withdraw->referral_earnings) }}</td>
                        @endif
                        <td>{{ display_price_currency($withdraw->amount) }}</td>
                        <td><?= (isset($withdrawal_methods[$withdraw->method])) ?
                                $withdrawal_methods[$withdraw->method] : $withdraw->method ?></td>
                        <td><?= nl2br(e($withdraw->account)); ?></td>
                    </tr>
                @endforeach
                @php unset($article); @endphp
            </table>

            <div class="table-responsive">
                {{ $withdraws->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection
