<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Article[] $articles
 */
?>

@extends('layouts.member')

@section('title', e(__('Manage Article')))

@section('content')

    <div class="card mb-3">
        <div class="card-body">
            {!! Form::open([
                'route' => 'member.articles.index',
                'class' => 'form-inline',
                'method' => 'get'
            ]) !!}

            <div class="form-row">
                <div class="col">
                    {{ Form::text('Filter[title]', old('Filter[title]', request()->input('Filter.title')),
                        ['class' => 'form-control form-control-sm', 'placeholder' => __('Title')]) }}
                </div>

                <div class="col">
                    {{ Form::select('Filter[status]', get_article_statuses(), old('Filter[status]', request()->input('Filter.status')),
                        ['placeholder' => __('Status'), 'class' => 'form-control form-control-sm']) }}
                </div>

                <div class="col">
                    {{ Form::submit(__('Submit'), ['class' => 'btn btn-outline-primary btn-sm']) }}
                </div>

                <div class="col">
                    <a href="{{ route('member.articles.index') }}" class="btn btn-link btn-sm p-0">{{__('Reset')}}</a>
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>
                        {!! link_to_route('member.articles.index', __('Id'),
                        array_merge(request()->query(), ['order' => 'id', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>
                        {!! link_to_route('member.articles.index', __('Title'),
                        array_merge(request()->query(), ['order' => 'title', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Updated') }}</th>
                    <th>
                        {!! link_to_route('member.articles.index', __('Published'),
                        array_merge(request()->query(), ['order' => 'published_at', 'dir' => $orderBy['dir'], 'page' => 1]) ) !!}
                    </th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                </thead>

                <!-- Here is where we loop through our $posts array, printing out post info -->

                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            <a href="{{ route('member.articles.edit', [$article->id]) }}">{{ $article->title }}</a>
                        </td>
                        <td>{{ get_article_statuses($article->status) }}</td>
                        <td>{{ display_date_timezone($article->updated_at) }}</td>
                        <td>{{ display_date_timezone($article->published_at) }}</td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="btn btn-sm btn-primary" target="_blank" href="{{ $article->permalink() }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-sm btn-info"
                                   href="{{ route('member.articles.edit', [$article->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form name="{{$form = uniqid('fd_')}}" style="display:none;" method="post"
                                      action="{{ route('member.articles.destroy', [$article->id]) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>
                                <a href="#" class="btn btn-sm btn-danger "
                                   onclick="if (confirm(&quot;Are you sure?&quot;)) { document.{{$form}}.submit(); } event.returnValue = false; return false;">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                @php unset($article); @endphp
            </table>

            <div class="table-responsive">
                {{ $articles->appends(request()->except(['page']))->links() }}
            </div>

        </div><!-- /.box-body -->
    </div>

@endsection
