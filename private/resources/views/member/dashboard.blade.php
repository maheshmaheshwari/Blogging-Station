@extends('layouts.member')

@section('title', e(__('Member Area')))

@section('content')

    <form method="get" action="{{ route('member.dashboard') }}" class="d-flex justify-content-center">
        <div class="form-group">
            {!!
            Form::select('month', $year_month, old('month', request()->get('month')),
                ['class' => 'form-control form-control-lg select2', 'onchange' => 'this.form.submit();', 'style' => 'width: 300px;']);
            !!}
        </div>
    </form>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ display_number($total_views) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Paid Views') }}</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ display_price_currency($author_earnings) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Author Earnings') }}</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3 border-right">
            <div class="text-center">
                <h4 class="text-success">{{ (!empty($total_views)) ? display_price_currency($author_earnings / $total_views * 1000) : 0 }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Average CPM') }}</div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
            <div class="text-center">
                <h4 class="text-success">{{ display_price_currency($referral_earnings) }}</h4>
                <div class="text-muted text-uppercase font-weight-bold small">{{ __('Referral Earnings') }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="far fa-chart-bar"></i> {{ __('Statistics') }}
        </div>
        <div class="card-body p-0 pt-3">
            <div id="chart_div" style="position: relative; height: 300px; width: 100%;"></div>

            <div style="height: 300px;overflow: auto;">
                <table class="table table-hover table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th><?= __('Date') ?></th>
                        <th><?= __('Views') ?></th>
                        <th><?= __('Views Earnings') ?></th>
                        <th><?= __('Daily CPM') ?></th>
                        @if ((bool)get_option('enable_referrals', 1))
                            <th><?= __('Referral Earnings') ?></th>
                        @endif
                    </tr>
                    </thead>
                    @foreach ($CurrentMonthDays as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value['view'] }}</td>
                            <td>{{ display_price_currency($value['author_earnings']) }}</td>
                            <td>
                                {{ (!empty($value['view'])) ? display_price_currency(($value['author_earnings'] / $value['view']) * 1000) : 0  }}
                            </td>
                            @if ((bool)get_option('enable_referrals', 1))
                                <td>{{ display_price_currency($value['referral_earnings']) }}</td>
                            @endif
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection

@push('footer')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/morrisjs/morris.js@0.5.1/morris.css">
    <script src="https://cdn.jsdelivr.net/gh/DmitryBaranovskiy/raphael@v2.1.0/raphael-min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/morrisjs/morris.js@0.5.1/morris.min.js"></script>

    <script>
        $(document).ready(function () {
            new Morris.Line({
                element: 'chart_div',
                resize: true,
                data: [
                    <?php
                    foreach ($CurrentMonthDays as $key => $value) {
                        $date = date("Y-m-d", strtotime($key));
                        echo '{date: "' . $date . '", views: ' . $value['view'] . '},';
                    }
                    ?>
                ],
                xkey: 'date',
                xLabels: 'day',
                ykeys: ['views'],
                labels: ['<?= __('Views') ?>'],
                lineColors: ['#3c8dbc'],
                lineWidth: 2,
                hideHover: 'auto',
                smooth: false,
            });
        });
    </script>
@endpush
