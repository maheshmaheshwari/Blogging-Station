<?php
/**
 * @var \Illuminate\Database\Eloquent\Builder|\App\Sidebar[] $sidebars
 */
?>

@extends('layouts.admin')

@section('title', e(__('Manage Sidebars')))

@section('content')

    <div class="card border">
        <div class="card-body">
            <form method="get" action="{{ route('admin.sidebars.index') }}" class="form-inline float-left">
                <div class="form-group">
                    <label for="sidebar_id">{{ __('Sidebar Select') }}</label>
                    <select name="sidebar_id" id="sidebar_id" required onchange="this.form.submit()"
                            class="form-control">
                        <option value="">{{ __('Choose') }}</option>
                        @foreach($sidebars as $key=>$val)
                            <option value="{{ $key }}" {{ (($key == old('sidebar_id', $sidebar_id))? "selected":"") }}>{{$val}}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="float-right">
                <button class="btn btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#sidebar-new">
                    {{ __('Add new sidebar') }}
                </button>
            </div>

            <div class="modal fade" id="sidebar-new" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add New Sidebar') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.sidebars.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Sidebar Name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if($sidebar)
        <div class="row">
            <div class="col-sm-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">{{ __('Add new widget') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.sidebar.widget.add') }}" class="form-sidebar-item">
                            @csrf
                            <input type="hidden" name="sidebar_id" value="{{ $sidebar_id }}">

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control"
                                       value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="type">{{ __('Type') }}</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">{{ __('Choose') }}</option>
                                    @foreach($widget_types as $key=>$val)
                                        <option value="{{ $key }}" {{ (($key == old('type'))? "selected":"") }}>{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn btn-primary">{{ __('Add') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <form name="{{$form = uniqid('form_')}}" style="display:none;" method="post"
                              action="{{route('admin.sidebars.destroy', [$sidebar->id])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>

                        <form method="post" action="{{ route('admin.sidebars.edit', [$sidebar->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group form-inline">
                                <label for="name">{{ __('Sidebar Name') }}</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $sidebar->name) }}" required>
                            </div>

                            <div class="form-group">
                                <ul id="sortable" class="list-group">
                                    @foreach($sidebar->widgets as $widget)
                                        <li class="ui-state-default list-group-item" data-id="{{ $widget['id'] }}">
                                            <i class="move fas fa-exchange-alt fa-rotate-90" data-toggle="tooltip" data-placement="left"
                                               title="{{ __('Move') }}"></i> {{ $widget['title'] ?? '' }}
                                            <a data-toggle="collapse" href="#widget-{{ $widget['id'] }}"
                                               class="btn btn-link btn btn-sm p-0 float-right">
                                                {{ __('Edit') }}
                                            </a>
                                            <div id="widget-{{ $widget['id'] }}" class="collapse"
                                                 style="margin-top: 5px;">
                                                <input type="hidden" name="item[{{ $widget['id'] }}][id]"
                                                       value="{{ old('item['.$widget['id'].']id', $widget['id']) }}">

                                                <input type="hidden" name="item[{{ $widget['id'] }}][type]"
                                                       value="{{ old('item['.$widget['id'].']type', $widget['type']) }}">

                                                <input type="hidden" name="item[{{ $widget['id'] }}][position]"
                                                       value="{{ old('item['.$widget['id'].']position', $widget['position']) }}">

                                                @includeWhen(($widget['type'] === 'recent_articles'), 'admin._partials.widgets.recent_articles')
                                                @includeWhen(($widget['type'] === 'popular_articles'), 'admin._partials.widgets.popular_articles')
                                                @includeWhen(($widget['type'] === 'ads'), 'admin._partials.widgets.ads')
                                                @includeWhen(($widget['type'] === 'newsletter'), 'admin._partials.widgets.newsletter')
                                                @includeWhen(($widget['type'] === 'author_about'), 'admin._partials.widgets.author_about')
                                                @includeWhen(($widget['type'] === 'author_popular'), 'admin._partials.widgets.author_popular')
                                                @includeWhen(($widget['type'] === 'recent_tweets'), 'admin._partials.widgets.recent_tweets')
                                                @includeWhen(($widget['type'] === 'follow_us'), 'admin._partials.widgets.follow_us')
                                                @includeWhen(($widget['type'] === 'html'), 'admin._partials.widgets.html')

                                                <div class="form-group">
                                                    <a href="#" class="widget-delete btn btn-danger btn-sm float-right">
                                                        {{ __('Delete') }}</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>

                                <a href="#" class="btn btn-danger float-right"
                                   onclick="if (confirm(&quot;Are you sure?&quot;)) { document.{{$form}}.submit(); } event.returnValue = false; return false;">
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('footer')
    <?php
    //<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css">
    ?>
    <style>
        .list-group-item > i {
            cursor: grabbing;
            margin-right: 15px;
        }
    </style>
    <script>
        $(function () {
            $("#sortable").sortable({
                //placeholder: "ui-state-highlight",
                handle: "i.move",
                items: "> li",
                cursor: 'move',
                opacity: 0.6,
                update: function (event, ui) {
                    widgetPositionsCorrect()
                    /*
                    $(this).find('> li').each(function (index, element) {
                        $(this).find('input[name="item[' + $(this).attr('data-id') + '][position]"]').val(index + 1);
                    });
                    */
                }
            });
        });

        $('.widget-delete').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                $(this).closest('li[data-id]').remove();
                widgetPositionsCorrect()
            }
            e.returnValue = false;
            return false;
        });

        function widgetPositionsCorrect() {
            $('#sortable > li').each(function (index, element) {
                $(this).find('input[name="item[' + $(this).attr('data-id') + '][position]"]').val(index + 1);
            });
        }
    </script>
@endpush
