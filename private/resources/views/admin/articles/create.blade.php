@extends('layouts.admin')

@section('title', e(__('Add Article')))

@section('content')

    <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-sm-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">{{ __('Add Article') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('title', __('Title')) }}
                            {{ Form::text('title', old('title'), ['class' => 'form-control', 'required' => true]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('slug', __('Slug(URL Key)')) }}
                            {{ Form::text('slug', old('slug'), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('summary', __('Summary')) }}
                            {{ Form::textarea('summary', old('summary'), ['class' => 'form-control', 'rows' => 3, 'required' => true]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('content', __('Content')) }}
                            {{ Form::textarea('content', old('content'), ['class' => 'form-control text-editor']) }}
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('SEO ') ?></div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::label('seo[title]', __('SEO Title')) }}
                            {{ Form::text('seo[title]', old('seo[title]'), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('seo[keywords]', __('SEO Keywords')) }}
                            {{ Form::text('seo[keywords]', old('seo[keywords]'), ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('seo[description]', __('SEO Description')) }}
                            {{ Form::textarea('seo[description]', old('seo[description]'), ['class' => 'form-control', 'rows' => 3]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('Article Settings') ?></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="status">{{ __('Status') }}</label>
                            <select class="form-control select2" name="status" id="status" required>
                                <option value="">{{ __('Choose') }}</option>
                                @foreach(get_article_statuses() as $key=>$val)
                                    <option value="{{ $key }}" {{ (($key === (int)old('status'))? "selected":"") }}>{{$val}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            {{ Form::label('user_id', 'User') }}
                            {{ Form::select('user_id', $users, old('user_id'), ['placeholder' => __('Choose'),
                            'class' => 'form-control select2', 'required' => true]) }}
                        </div>

                        <?php
                        /*
                        <div class="form-group">
                            {{ Form::label('pay_type', 'Pay Type') }}
                            {{ Form::select('pay_type', get_allowed_types(), old('pay_type'), ['placeholder' => __('Pay Type'),
                            'class' => 'form-control', 'required' => true]) }}
                        </div>

                        <div class="form-group conditional" data-condition="pay_type === '2'">
                            {{ Form::label('price', __('Price')) }}
                            {{ Form::number('price', old('price'), ['class' => 'form-control', 'step' => 'any', 'min' => 0]) }}
                            <small class="form-text text-muted">{{ __('For Pay Per Article, you should add a price that you '.
                            'will pay to the author upon approving the article.') }}</small>
                        </div>
                        */
                        ?>

                        <div class="form-group">
                            {{ Form::label('disable_earnings', __('Disable Earnings')) }}
                            {{ Form::select('disable_earnings', [0 => __('No'), 1 => __('Yes')],
                                old('disable_earnings'), ['class' => 'form-control select2', 'placeholder' => null]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('read_time', __('Recommended Read Time(in seconds)')) }}
                            {{ Form::number('read_time', old('read_time'), ['class' => 'form-control', 'min' => 0, 'step' => 1,]) }}
                            <small class="form-text text-muted">{{ __('Leave it empty to automatically generated') }}</small>
                        </div>

                        <div class="form-group">
                            {{ Form::label('message', __('Message to the Author')) }}
                            {{ Form::textarea('message', old('message'), ['class' => 'form-control', 'rows' => 5]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::submit(__('Submit'), ['class' => 'btn btn-primary']) }}
                        </div>

                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('Featured Image') ?></div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::file('upload_featured_image', ['accept' => '.jpg,.jpeg,.png,.gif']) }}
                        </div>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('Categories') ?></div>
                    <div class="card-body">
                        <table class="table table-sm">
                            @foreach ($categories as $id => $name)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="categories[]" value="{{ $id }}"
                                                       @if(in_array($id, old('categories', []))) checked @endif
                                                       class="form-check-input"> {{ $name }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group mb-0 text-muted">
                                            <label class="mb-0">
                                                <input class="form-check-input" type="radio" name="main_category"
                                                       @if((int)old('main_category') === $id) checked @endif
                                                       value="{{ $id }}" required> {{ __('Primary') }}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header"><?= __('Tags') ?></div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::select('tags[]', $tags, old('tags[]'), ['class' => 'form-control select2',
                            'multiple' => true, 'required' => false]) }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>

@endsection

@include('_partials.editor')

@push('footer')
    <script>
        $("input[name='main_category']").on('change', function () {
            var val = $(this).val();

            $("input[name='categories[]'][value='" + val + "']").prop('checked', true);
        });

        $("input[name='categories[]']").on('change', function () {
            if ($("input[name='main_category']").is(":checked")) {
                return;
            }

            var val = $(this).val();

            if ($(this).is(":checked")) {
                $("input[name='main_category'][value='" + val + "']").prop('checked', true);
            }
        });

        /*
        $(document).ready(function () {
            $("input[name='categories[]']").trigger('change');
        });

        $("input[name='categories[]']").on('change', function () {
            console.log(this);
            $(this).prop('required', false);
            if ($(this).is(":checked")) {
                $(this).prop('required', true);
            }

            if (!$("input[name='categories[]']:checked").length > 0) {
                $.each($("input[name='categories[]']"), function( key, value ) {
                    $(this).prop('required', true);
                });
            }
        });
        */
    </script>
@endpush
