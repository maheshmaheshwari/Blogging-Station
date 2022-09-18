@extends('layouts.admin')

@section('title', e(__('Add Ad')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Add Ad') }}</div>
        <div class="card-body">
            <form action="{{ route('admin.ads.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    {{ Form::label('name', __('Name')) }}
                    {{ Form::text('name', old('name'), ['class' => 'form-control', 'required' => true]) }}
                </div>

                <div class="form-group">
                    <label for="status">{{ __('Status') }}</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="">{{ __('Choose') }}</option>
                        @foreach(get_page_statuses() as $key=>$val)
                            <option value="{{ $key }}" {{ (($key === old('status'))? "selected":"") }}>{{$val}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="code_textarea">{{ __('Code') }}</label>
                    <textarea class="form-control" name="code" id="code_textarea"><?= old('code'); ?></textarea>
                    <pre id="code" style="height: 500px"></pre>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
                </div>
            </form>
        </div>
    </div>

@endsection

@push('header')
@endpush

@push('footer')
    <script src="https://cdn.jsdelivr.net/gh/ajaxorg/ace-builds@1.4.1/src-min-noconflict/ace.js"></script>
    <script>
        var editor = ace.edit("code");
        editor.setTheme("ace/theme/dracula");
        editor.session.setMode("ace/mode/php");

        // https://stackoverflow.com/a/7979758/1794834
        var textarea = $('#code_textarea').hide();
        editor.getSession().setValue(textarea.val());
        editor.getSession().on('change', function () {
            textarea.val(editor.getSession().getValue());
        });
    </script>
@endpush
