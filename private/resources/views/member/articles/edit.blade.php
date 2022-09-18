@extends('layouts.member')

@section('title', e(__('Edit Article')))

@section('content')

    <form method="post" action="{{ route('member.articles.update', $article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card bg-light">
            <div class="card-header">{{ __('Edit Article') }}</div>
            <div class="card-body">

                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" name="title" id="title" class="form-control" required
                           value="{{ old('title', $article_update->title) }}">
                </div>

                <div class="form-group" style="display: none">
                    <label for="slug">{{ __('Slug(URL Key)') }}</label>
                    <input type="text" name="slug" id="slug" class="form-control"
                           value="{{ old('slug', $article_update->slug) }}">
                </div>

                <div class="form-group">
                    <label for="summary">{{ __('Summary') }}</label>
                    <textarea id="summary" name="summary" class="form-control" rows="3"
                              required>{{ old('summary', $article_update->summary) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">{{ __('Content') }}</label>
                    <textarea id="content" name="content" class="form-control text-editor"
                              required>{{ old('content', $article_update->content) }}</textarea>
                </div>

                <div class="form-group row d-flex align-items-center">
                    <label for="upload_featured_image" class="col-2 col-form-label">
                        @if($article_update->featured_image_id)
                            <img src="{{ asset(\App\File::find($article_update->featured_image_id)->file) }}"
                                 style="max-width: 100%;">
                        @endif
                    </label>
                    <div class="col-10">
                        <input type="file" name="upload_featured_image" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="form-group">
                    <label for="reason">{{ __('Message to the Reviewer') }}</label>
                    <textarea id="reason" name="reason" class="form-control" rows="5"
                              required>{{ old('reason') }}</textarea>
                    <small class="form-text text-muted">
                        <?= __('You must give a brief description of any changes you have made.') ?>
                    </small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>

            </div>
        </div>

    </form>

@endsection

@include('_partials.editor')
