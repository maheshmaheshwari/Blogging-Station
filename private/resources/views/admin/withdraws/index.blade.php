<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Withdraw[] $withdraws
 */

$withdrawal_methods = array_column(get_withdrawal_methods(), 'name', 'id');
?>

@extends('layouts.admin')

@section('title', e(__('Manage Withdrawals')))

@section('content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-wave bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{ display_price_currency($authors_earnings) }}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{ __('Authors Earnings') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-exchange-alt bg-info p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{ display_price_currency($referral_earnings) }}</div>
                        <div
                            class="text-muted text-uppercase font-weight-bold small">{{ __('Referral Earnings') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-search-dollar bg-warning p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{ display_price_currency($pending_withdrawn) }}</div>
                        <div
                            class="text-muted text-uppercase font-weight-bold small">{{ __('Pending Withdrawn') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-hand-holding-usd bg-danger p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-info">{{ display_price_currency($total_withdrawn) }}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">{{ __('Total Withdrawn') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="get" action="{{ route('admin.withdraws.index') }}" class="form-inline">

                <div class="form-group">
                    {{ Form::text('Filter[user_id]', old('Filter[user_id]', request()->input('Filter.user_id')), ['class' => 'form-control',
                        'placeholder' => __('User Id')]) }}
                </div>

                <div class="form-group">
                    {{ Form::select('Filter[status]', get_withdraw_statuses(), old('Filter[status]', request()->input('Filter.status')),
                        ['placeholder' => __('Status'), 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::select('Filter[method]', $withdrawal_methods, old('Filter[method]', request()->input('Filter.method')),
                        ['placeholder' => __('Method'), 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-outline-primary']) }}
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.withdraws.index') }}" class="btn btn-link btn-sm'">{{__('Reset')}}</a>
                </div>

            </form>

        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>
                            {!! link_to_route('admin.withdraws.index', __('Id'),
                                array_merge(request()->query(), ['order' => 'id', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                        </th>
                        <th>{{ __('Author') }}</th>
                        <th>
                            {!! link_to_route('admin.withdraws.index', __('Date'),
                                array_merge(request()->query(), ['order' => 'created_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                        </th>
                        <th>{{ __('Status') }}</th>
                        <th>
                            {!! link_to_route('admin.withdraws.index', __('Author Earnings'),
                                array_merge(request()->query(), ['order' => 'author_earnings', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                        </th>
                        <th>
                            {!! link_to_route('admin.withdraws.index', __('Referral Earnings'),
                                array_merge(request()->query(), ['order' => 'referral_earnings', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                        </th>
                        <th>
                            {!! link_to_route('admin.withdraws.index', __('Total Amount'),
                                array_merge(request()->query(), ['order' => 'amount', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                        </th>
                        <th>{{ __('Withdrawal Method') }}</th>
                        <th>{{ __('Withdrawal Account') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($withdraws as $withdraw)
                        <tr>
                            <td>
                                <a href="{{ route('admin.withdraws.show', [$withdraw->id]) }}">{{ $withdraw->id }}</a>
                            </td>
                            <td>{{ $withdraw->user->name }}</td>
                            <td>{{ display_date_timezone($withdraw->created_at) }}</td>
                            <td>{{ get_withdraw_statuses($withdraw->status) }}</td>
                            <td>{{ display_price_currency($withdraw->author_earnings) }}</td>
                            @if ((bool)get_option('enable_referrals', 1))
                                <td>{{ display_price_currency($withdraw->referral_earnings) }}</td>
                            @endif
                            <td>{{ display_price_currency($withdraw->amount) }}</td>
                            <td>{{ $withdrawal_methods[$withdraw->method] ?? $withdraw->method }}</td>
                            <td><?= nl2br(e($withdraw->account)); ?></td>

                            <td>
                                <div class="d-inline-flex">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route('admin.withdraws.show', [$withdraw->id]) }}">{{ __("View") }}</a>


                                    @if ($withdraw->status == 2)
                                        <form method="post"
                                              action="{{ route('admin.withdraws.approve', [$withdraw->id]) }}"
                                              onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-success btn-sm">{{ __('Approve') }}</button>
                                        </form>
                                    @endif

                                    @if ($withdraw->status == 1)
                                        <form method="post"
                                              action="{{ route('admin.withdraws.complete', [$withdraw->id]) }}"
                                              onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-success btn-sm">{{ __('Complete') }}</button>
                                        </form>
                                    @endif

                                    @if (in_array($withdraw->status, [1, 2]))
                                        <form method="post"
                                              action="{{ route('admin.withdraws.cancel', [$withdraw->id]) }}"
                                              onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">{{ __('Cancel') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    @php unset($withdraw); @endphp
                </table>

                {{ $withdraws->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection
