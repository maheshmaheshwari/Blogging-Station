@extends('layouts.admin')

@section('title', e(__('Dashboard')))

@section('content')

    <form method="get" action="{{ route('admin.dashboard') }}" class="d-flex justify-content-center">
        <div class="form-group">
            {!!
            Form::select('month', $year_month, old('month', request()->get('month')),
                ['class' => 'form-control form-control-lg select2', 'onchange' => 'this.form.submit();', 'style' => 'width: 300px;']);
            !!}
        </div>
    </form>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="far fa-file-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Published Articles') }}</span>
                    <span class="info-box-number">{{ display_number($articles) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Author Earnings') }}</span>
                    <span class="info-box-number">{{ display_price_currency($author_earnings) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-exchange-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Referral Earnings') }}</span>
                    <span class="info-box-number">{{ display_price_currency($referral_earnings) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('Paid Views') }}</span>
                    <span class="info-box-number">{{ display_number($total_views) }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0"><i class="fa fa-bar-chart"></i> {{ __('Statistics') }}</h5>
        </div>
        <div class="card-body p-0 pt-3">
            <div id="chart_div" style="position: relative; height: 300px; width: 100%;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card border-primary">
                <div class="card-header text-white bg-primary">
                    <h5 class="m-0"><i class="far fa-file-alt"></i> {{ __('New Articles') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group" style="height: 300px; overflow: auto;">
                        @if($new_articles->count())
                            @foreach($new_articles as $new_article)
                                <li class="list-group-item">
                                    <a href="{{ route('admin.articles.edit', [$new_article->id]) }}">
                                        <h5 class="mb-1">
                                            <i class="fa fa-angle-double-right"></i> {{ $new_article->title }}
                                        </h5>
                                    </a>
                                    <span class="text-muted">
                                        <i class="fa fa-calendar"></i> {{ display_date_timezone($new_article->created_at) }} -
                                        <i class="fa fa-user"></i> {{ $new_article->user->name }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            {{ __('No data.') }}
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-success">
                <div class="card-header text-white bg-success">
                    <h5 class="m-0"><i class="fa fa-fire"></i> {{ __('Popular Articles') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group" style="height: 300px; overflow: auto;">
                        @if($popular_articles->count())
                            @foreach($popular_articles as $popular_article)
                                <li class="list-group-item">
                                    <a href="{{ route('admin.articles.edit', [$popular_article->article->id]) }}">
                                        <h5 class="mb-1">
                                            <i class="fa fa-angle-double-right"></i> {{ $popular_article->article->title }}
                                        </h5>
                                    </a>
                                    <span class="text-muted">
                                        <i class="fa fa-calendar"></i> {{ display_date_timezone($popular_article->article->created_at) }} -
                                        <i class="fa fa-eye"></i> {{ $popular_article->views }} -
                                        <i class="fa fa-user"></i> {{ $popular_article->article->user->name }}
                                    </span>
                                </li>
                            @endforeach
                        @else
                            {{ __('No data.') }}
                        @endif
                    </ul>
                </div>
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
