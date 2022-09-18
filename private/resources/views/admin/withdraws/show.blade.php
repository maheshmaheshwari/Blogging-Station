<?php
/**
 * @var \App\Withdraw $withdraw
 */
$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');
?>

@extends('layouts.admin')

@section('title', e(__('Withdrawal Request #:id', ['id' => $withdraw->id])))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-body">
            <h3 class="card-title">
                <i class="fas fa-hand-holding-usd"></i> {{ __('Withdrawal Request #:id', ['id' => $withdraw->id]) }}
            </h3>
            <div class="d-inline-flex mb-3">
                @if ($withdraw->status == 2)
                    <form method="post" action="{{ route('admin.withdraws.approve', [$withdraw->id]) }}"
                          onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">{{ __('Approve') }}</button>
                    </form>
                @endif

                @if ($withdraw->status == 1)
                    <form method="post" action="{{ route('admin.withdraws.complete', [$withdraw->id]) }}"
                          onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">{{ __('Complete') }}</button>
                    </form>
                @endif

                @if (in_array($withdraw->status, [1, 2]))
                    <form method="post" action="{{ route('admin.withdraws.cancel', [$withdraw->id]) }}"
                          onsubmit="return confirm('{{ __('Are you sure?') }}');">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('Cancel') }}</button>
                    </form>
                @endif
            </div>

            <table class="table table-hover table-striped">
                <tr>
                    <td><?= __('ID') ?></td>
                    <td>{{ $withdraw->id }}</td>
                </tr>
                <tr>
                    <td><?= __('Status') ?></td>
                    <td>{{ get_withdraw_statuses($withdraw->status) }}</td>
                </tr>
                <tr>
                    <td><?= __('Author Earnings') ?></td>
                    <td><?= display_price_currency($withdraw->author_earnings); ?></td>
                </tr>
                <tr>
                    <td><?= __('Referral Earnings') ?></td>
                    <td><?= display_price_currency($withdraw->referral_earnings); ?></td>
                </tr>
                <tr>
                    <td><?= __('Amount') ?></td>
                    <td><?= display_price_currency($withdraw->amount) ?></td>
                </tr>
                <tr>
                    <td><?= __('Withdrawal Method') ?></td>
                    <td>{{ $withdrawal_methods[$withdraw->method] ?? $withdraw->method }}</td>
                </tr>
                <tr>
                    <td><?= __('Withdrawal Account') ?></td>
                    <td><?= nl2br(e($withdraw->account)); ?></td>
                </tr>
                <tr>
                    <td><?= __('Username') ?></td>
                    <td>{{ $withdraw->user->username }}</td>
                </tr>
                <tr>
                    <td><?= __('Created Date') ?></td>
                    <td><?= display_date_timezone($withdraw->created_at); ?></td>
                </tr>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <i class="fa fa-list"></i> {{ __("Reasons") }}
        </div>
        <div class="card-body p-0" style="max-height: 300px; overflow: auto;">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('Reason') ?></th>
                    <th><?= __('Count') ?></th>
                </tr>
                </thead>
                @foreach ($reasons as $reason)
                    <tr>
                        <td><?= get_statistics_reasons($reason->reason) ?></td>
                        <td><?= $reason->count ?></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <i class="fa fa-globe"></i> {{ __("Countries") }}
        </div>
        <div class="card-body p-0" style="max-height: 300px; overflow: auto;">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('Country') ?></th>
                    <th><?= __('Count') ?></th>
                    <th><?= __('Author Earnings') ?></th>
                </tr>
                </thead>
                <?php
                $countries_list = get_countries(true);
                ?>
                @foreach ($countries as $country)
                    <tr>
                        <td><?= $countries_list[$country->country] ?? __('Others') ?></td>
                        <td><?= $country->count ?></td>
                        <td><?= $country->author_earnings ?></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <i class="fa fa-hand-pointer-o"></i> {{ __("IP Addresses") }}
        </div>
        <div class="card-body p-0" style="max-height: 300px; overflow: auto;">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('IP Address') ?></th>
                    <th><?= __('Count') ?></th>
                    <th><?= __('Author Earnings') ?></th>
                </tr>
                </thead>
                @foreach ($ips as $ip)
                    <tr>
                        <td><?= $ip->ip ?></td>
                        <td><?= $ip->count ?></td>
                        <td><?= $ip->author_earnings ?></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <i class="fa fa-share"></i> {{ __("Referrers") }}
        </div>
        <div class="card-body p-0" style="max-height: 300px; overflow: auto;">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('Referrer') ?></th>
                    <th><?= __('Count') ?></th>
                    <th><?= __('Author Earnings') ?></th>
                </tr>
                </thead>
                @foreach ($referrers as $referrer)
                    <tr>
                        <td>{{ $referrer->referrer ?? __('Direct') }}</td>
                        <td><?= $referrer->count ?></td>
                        <td><?= $referrer->author_earnings ?></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="card border-primary">
        <div class="card-header text-white bg-primary">
            <i class="fa fa-file-text-o"></i> {{ __("Articles") }}
        </div>
        <div class="card-body p-0" style="max-height: 300px; overflow: auto;">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                <tr>
                    <th><?= __('Article') ?></th>
                    <th><?= __('Count') ?></th>
                    <th><?= __('Author Earnings') ?></th>
                </tr>
                </thead>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->article->title }}</td>
                        <td><?= $article->count ?></td>
                        <td><?= $article->author_earnings ?></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection
