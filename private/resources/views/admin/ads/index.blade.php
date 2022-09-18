<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Ad[] $ads
 */
?>

@extends('layouts.admin')

@section('title', e(__('Manage Ads')))

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="get" action="{{ route('admin.ads.index') }}" class="form-inline">

                <div class="form-group">
                    <input type="text" name="Filter[name]" placeholder="{{ __('Name') }}" class="form-control"
                           value="{{ old('Filter[name]', request()->input('Filter.name')) }}">
                </div>

                <div class="form-group">
                    {{ Form::select('Filter[status]', get_article_statuses(), old('Filter[status]', request()->input('Filter.status')),
                        ['placeholder' => __('Status'), 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-outline-primary" value="{{ __('Submit') }}">
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.ads.index') }}" class="btn btn-link btn-sm'">{{__('Reset')}}</a>
                </div>

            </form>

        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <i class="fas fa-ad"></i> {{ __('Ads') }}
            <button class="btn btn-primary btn-sm float-right"
                    onclick="window.location.href='{{ route('admin.ads.create') }}'">
                <i class="fa fa-plus"></i> {{ __('Add Ad') }}</button>
        </div>
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>
                        {!! link_to_route('admin.ads.index', __('Id'),
                            array_merge(request()->query(), ['order' => 'id', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.ads.index', __('Name'),
                            array_merge(request()->query(), ['order' => 'name', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Status') }}</th>
                    <th>
                        {!! link_to_route('admin.ads.index', __('Updated'),
                            array_merge(request()->query(), ['order' => 'updated_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.ads.index', __('Created'),
                            array_merge(request()->query(), ['order' => 'created_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                @foreach ($ads as $ad)
                    <tr>
                        <td>{{ $ad->id }}</td>
                        <td>
                            <a href="{{ route('admin.ads.edit', [$ad->id]) }}">{{ $ad->name }}</a>
                        </td>
                        <td>{{ $ad->status }}</td>
                        <td>{{ display_date_timezone($ad->updated_at) }}</td>
                        <td>{{ display_date_timezone($ad->created_at) }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.ads.edit', [$ad->id]) }}">
                                <i class="fas fa-pencil-alt"></i>
                            </a>

                            {!! delete_form('admin.ads.destroy', $ad->id) !!}
                        </td>
                    </tr>
                @endforeach
                @php unset($ad); @endphp
            </table>

            <div class="table-responsive">
                {{ $ads->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection
