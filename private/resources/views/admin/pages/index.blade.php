<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Page[] $pages
 */
?>

@extends('layouts.admin')

@section('title', e(__('Manage Pages')))

@section('content')

    <div class="card border">
        <div class="card-body">
            <form method="get" action="{{ route('admin.pages.index') }}" class="form-inline">

                <div class="form-group">
                    <input type="text" name="Filter[title]" placeholder="{{ __('Title') }}" class="form-control"
                           value="{{ old('Filter[title]', request()->input('Filter.title')) }}">
                </div>

                <div class="form-group">
                    <input type="text" name="Filter[slug]" placeholder="{{ __('Slug') }}" class="form-control"
                           value="{{ old('Filter[slug]', request()->input('Filter.slug')) }}">
                </div>

                <div class="form-group">
                    {{ Form::select('Filter[status]', get_page_statuses(), old('Filter[status]', request()->input('Filter.status')),
                        ['placeholder' => __('Status'), 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-outline-primary" value="{{ __('Submit') }}">
                </div>

                <div class="form-group">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-link btn-sm'">{{__('Reset')}}</a>
                </div>

            </form>

        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">
                <i class="far fa-copy"></i> {{ __('Pages') }}
                <button class="btn btn-primary btn-sm float-right"
                        onclick="window.location.href='{{ route('admin.pages.create') }}'">
                    <i class="fa fa-plus"></i> {{ __('Add Page') }}</button>
            </h5>
        </div>
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <tr>
                    <th>
                        {!! link_to_route('admin.pages.index', __('Id'),
                            array_merge(request()->query(), ['order' => 'id', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.pages.index', __('Title'),
                            array_merge(request()->query(), ['order' => 'title', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.pages.index', __('Slug'),
                            array_merge(request()->query(), ['order' => 'slug', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Updated') }}</th>
                    <th>
                        {!! link_to_route('admin.pages.index', __('Created'),
                            array_merge(request()->query(), ['order' => 'created_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Actions') }}</th>
                </tr>

                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->id }}</td>
                        <td>
                            <a href="{{ route('admin.pages.edit', [$page->id]) }}">{{ $page->title }}</a>
                        </td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ get_page_statuses($page->status) }}</td>
                        <td>{{ display_date_timezone($page->updated_at) }}</td>
                        <td>{{ display_date_timezone($page->created_at) }}</td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="btn btn-sm btn-primary" target="_blank" href="{{ $page->permalink() }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {!! delete_form('admin.pages.destroy', $page->id) !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                @php unset($page); @endphp
            </table>

            <div class="table-responsive">
                {{ $pages->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection
