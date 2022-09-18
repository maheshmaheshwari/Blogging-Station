<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Tag[] $tags
 * @var \App\Tag $tag
 */
?>

@extends('layouts.admin')

@section('title', e(__('Manage Tag')))

@section('content')

    <div class="card border">
        <div class="card-body">
            {!! Form::open([
                'route' => 'admin.tags.index',
                'class' => 'form-inline',
                'method' => 'get'
            ]) !!}

            {{ Form::text('Filter[name]', old('Filter[name]', request()->input('Filter.name')), ['class' => 'form-control',
                'placeholder' => __('Name')]) }}

            {{ Form::text('Filter[slug]', old('Filter[slug]', request()->input('Filter.slug')), ['class' => 'form-control',
                'placeholder' => __('slug')]) }}

            <div class="form-group">
                {{ Form::submit(__('Submit'), ['class' => 'btn btn-outline-primary']) }}
            </div>

            <div class="form-group">
                <a href="{{ route('admin.tags.index') }}" class="btn btn-link btn-sm'">{{__('Reset')}}</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <i class="fa fa-tags"></i> {{ __('Tags') }}
            <button class="btn btn-primary btn-sm float-right"
                    onclick="window.location.href='{{ route('admin.tags.create') }}'">
                <i class="fa fa-plus"></i> {{ __('Add Tag') }}</button>
        </div>
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>
                        {!! link_to_route('admin.tags.index', __('Id'),
                            array_merge(request()->query(), ['order' => 'id', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.tags.index', __('Name'),
                            array_merge(request()->query(), ['order' => 'name', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('admin.tags.index', __('Slug'),
                            array_merge(request()->query(), ['order' => 'slug', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Published') }}</th>
                    <th>{{ __('Updated at') }}</th>
                    <th>
                        {!! link_to_route('admin.tags.index', __('Created at'),
                            array_merge(request()->query(), ['order' => 'created_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <!-- Here is where we loop through our $posts array, printing out post info -->

                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>
                            <a href="{{ route('admin.tags.edit', [$tag->id]) }}">{{ $tag->name }}</a>
                        </td>
                        <td>{{ $tag->slug }}</td>
                        <td>@php echo ($tag->status) ? __('Yes') : __('No') @endphp</td>
                        <td>{{ display_date_timezone($tag->updated_at)  }}</td>
                        <td>{{ display_date_timezone($tag->created_at) }}</td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="btn btn-sm btn-primary" target="_blank" href="{{ $tag->permalink() }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                {!! delete_form('admin.tags.destroy', $tag->id) !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                @php unset($tag); @endphp
            </table>

            <div class="table-responsive">
                {{ $tags->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection

