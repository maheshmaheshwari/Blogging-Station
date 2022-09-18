<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder $items
 */
?>
@extends('layouts.admin')

@section('title', e(__('Language Manager')))

@section('content')

    <div class="card border">
        <div class="card-body">
            <div class="modal fade" id="sidebar-new" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add New Language') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.language.create') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">{{ __('Language Code') }}</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name') }}" minlength="2" maxlength="2" required>
                                    <small class="form-text text-muted">{{ __('Ex. es, fr or ar') }}</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#sidebar-new">
                    {{ __('Add New Language') }}
                </button>
            </div>

            <table class="table table-responsive-sm table-striped">
                <thead class="thead-light">
                <tr>
                    <th>{{ __('Language Code') }}</th>
                    <th>{{ __('Language Name') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
                @foreach($languages as $language)
                    <tr>
                        <td>{{ $language }}</td>
                        <td>{{ locale_get_display_name($language, $language) }}</td>
                        <td>
                            <div class="d-inline-flex">
                                <a class="btn btn-success btn-sm"
                                   href="{{ route('admin.language.index', ['edit_language' => $language]) }}">
                                    {{ __('Edit Translations') }}
                                </a>

                                @if($language !== 'en')
                                    <form method="post" action="{{ route('admin.language.destroy', [$language]) }}"
                                          name="{{$form = uniqid('form_')}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="if (confirm(&quot;Are you sure?&quot;)) { document.{{$form}}.submit(); } event.returnValue = false; return false;"
                                        >{{ __('Delete') }}</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

    @if($edit_language)
        <div class="card card-primary card-outline">
            <div class="card-body">

                <h3 class=card-title>{{ __('Edit Translations For Language:') }} {{ locale_get_display_name($edit_language, $edit_language) }}</h3>

                <table class="table table-responsive-sm table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>{{ __('Key') }}</th>
                        <th>{{ __('Translation') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.translation.delete') }}"
                                      name="{{ $form = uniqid('f_') }}" style="display: none;">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="language" value="{{ $edit_language }}">
                                    <input type="hidden" name="key" value="{!! base64_encode($key) !!}">
                                </form>
                                <form method="post" action="{{ route('admin.translation.update') }}">
                                    @csrf
                                    <input type="hidden" name="language" value="{{ $edit_language }}">
                                    <input type="hidden" name="key" value="{!! base64_encode($key) !!}">
                                    <textarea name="translation" class="form-control" required
                                              placeholder="{{ __('Translation') }}">{{ $value }}</textarea>
                                    <div class="d-inline-flex">
                                        <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="if (confirm(&quot;{{ __('Are you sure?') }}&quot;)) { document.{{ $form }}.submit(); } event.returnValue = false; return false;">{{ __('Delete') }}</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="table-responsive">
                    {{ $items->appends(request()->except(['page']))->links() }}
                </div>

            </div>
        </div>
    @endif

@endsection
