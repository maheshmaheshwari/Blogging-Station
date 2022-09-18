<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Category[] $categories
 */
?>

@extends('layouts.admin')

@section('title', e(__('Manage Categories')))

@section('content')

    <?php
    //dump(\App\Category::categoryTree(0, 'array'));
    //dump(\App\Category::categoryTree(0, 'select'));
    ?>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <i class="fas fa-layer-group"></i> {{ __('Categories') }}
            <button class="btn btn-primary btn-sm float-right"
                    onclick="window.location.href='{{ route('admin.categories.create') }}'">
                <i class="fa fa-plus"></i> {{ __('Add Category') }}</button>
        </div>
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>{{ __('Id') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Slug') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Updated at') }}</th>
                    <th>{{ __('Created at') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                {{ \App\Category::display_categories($categories) }}

                <?php
                /*
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', [$category->id]) }}">{{ $category->name }}</a>
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>@php echo ($category->published) ? __('Yes') : __('No') @endphp</td>
                        <td>{{ $category->updated_at  }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" target="_blank"
                               href="{{ route('category.show', [$category->id, $category->slug]) }}"><i
                                        class="fa fa-eye"></i></a>

                            {!! delete_form('admin.categories.destroy', $category->id) !!}
                        </td>
                    </tr>
                @endforeach
                @php unset($category); @endphp
                */
                ?>
            </table>

        </div><!-- /.box-body -->
    </div>


@endsection
