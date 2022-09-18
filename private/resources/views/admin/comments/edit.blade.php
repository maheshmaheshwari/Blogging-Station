@extends('layouts.admin')

@section('title', e(__('Edit Comment')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">{{ __('Edit Comment') }}</div>
        <div class="card-body">

            <dl>
                <dt>{{ __('Article') }}</dt>
                <dd><a href="{{ $comment->article->permalink() }}"
                       target="_blank">{{ $comment->article->title  }}</a></dd>
            </dl>

            <form action="{{ route('admin.comments.update', $comment->id) }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="status">{{ __('Status') }}</label>
                    <select class="form-control" name="status" id="status" required>
                        <option value="">{{ __('Choose') }}</option>
                        @foreach(get_comment_statuses() as $key => $val)
                            <option value="{{ $key }}" {{ (($key === old('status', $comment->status))? "selected":"") }}>{{$val}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="content">{{ __('Content') }}</label>
                    <textarea class="form-control" name="content" id="content"><?= old('content',
                            $comment->content); ?></textarea>
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
@endpush
