@extends('layouts.admin')

@section('title', e(__('Home Page')))

@section('content')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h5 class="m-0">
                <i class="nav-icon fa fa-table"></i> {{ __('Home Page') }}
            </h5>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.pages.homepage.store') }}">
                @csrf

                <div class="form-group">
                    <label for="code_textarea">{{ __('Content(HTML/JavaScript accepted)') }}</label>
                    <textarea class="form-control" name="homepage"
                              id="code_textarea"><?= old('homepage', $homepage); ?></textarea>
                    <pre id="code" style="height: 500px"></pre>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{ __('Submit') }}">
                </div>
            </form>

        </div>
    </div>
@endsection

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
