@extends('layouts.admin')

@section('title', e(__('Withdrawal Methods')))

@section('content')

    <div class="card card-primary card-outline">
        <div class="card-header">
            <i class="fas fa-hand-holding-usd"></i> {{ __("Withdrawal Methods") }}

            <div class="float-right">
                <button class="btn btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#method-new">
                    {{ __('Add new method') }}
                </button>
            </div>

            <div class="modal fade" id="method-new" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add new method') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('admin.withdraws.methods') }}">
                                @csrf
                                <input type="hidden" name="type" value="new">

                                <div class="form-group">
                                    <label>{{ __('Method name') }}</label>
                                    <input type="text" name="name" value="" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Method id') }}</label>
                                    <input type="text" name="id" value="" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Status') }}</label>
                                    {{ Form::select('status', [1 => __('Active'), 0 => __('Inactive')],
                                    old('status'), ['class' => 'form-control', 'placeholder' => __('Status'), 'required' => true] ) }}
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Method logo image') }}</label>
                                    <input type="text" name="image" value="" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Minimum withdrawal amount') }}</label>
                                    <input type="number" name="amount" value="" class="form-control" min="0" step="any"
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.withdraws.methods') }}">
                @csrf
                <input type="hidden" name="type" value="update">

                <div class="form-group">
                    <ul id="sortable" class="list-group">
                        @foreach($withdrawal_methods as $key => $method)
                            <li class="ui-state-default list-group-item" data-id="{{ $key }}">
                                <i class="fa fa-arrows"></i> {{ $method['name'] ?? '' }}
                                <a data-toggle="collapse" href="#method-{{ $key }}"
                                   class="btn btn-link btn btn-sm p-0 float-right">
                                    {{ __('Edit') }}
                                </a>
                                <div id="method-{{ $key }}" class="collapse" style="margin-top: 5px;">

                                    <div class="form-group">
                                        <label>{{ __('Method name') }}</label>
                                        <input type="text" name="method[{{ $key }}][name]" class="form-control"
                                               placeholder="{{ __('Method name') }}" required
                                               value="{{ old('item['.$key.']name', $method['name']) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Method id') }}</label>
                                        <input type="text" name="method[{{ $key }}][id]" class="form-control"
                                               placeholder="{{ __('Method id') }}" required
                                               value="{{ old('item['.$key.']id', $method['id']) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Status') }}</label>
                                        {{ Form::select('method['.$key.'][status]', [1 => __('Active'), 0 => __('Inactive')],
                                            old('method['.$key.'][status]', $method['status'] ), ['class' => 'form-control',
                                            'placeholder' => __('Status'), 'required' => true] ) }}
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Method logo image') }}</label>
                                        <input type="text" name="method[{{ $key }}][image]" class="form-control"
                                               placeholder="{{ __('Method logo image') }}" required
                                               value="{{ old('item['.$key.']image', $method['image']) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>{{ __('Minimum withdrawal amount') }}</label>
                                        <input type="number" name="method[{{ $key }}][amount]" class="form-control"
                                               placeholder="{{ __('Minimum withdrawal amount') }}" required
                                               value="{{ old('item['.$key.']amount', $method['amount']) }}"
                                               min="0" step="any">
                                    </div>

                                    <div class="form-group">
                                        <a href="#" class="method-delete btn btn-danger btn-sm float-right">
                                            {{ __('Delete') }}</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('footer')
    <style>
        .list-group-item {
            cursor: grabbing;
        }

        .list-group-item > i {
            margin-right: 15px;
        }
    </style>
    <script>
        $(function () {
            $("#sortable").sortable({
                //placeholder: "ui-state-highlight",
                items: "> li",
                cursor: 'move',
                opacity: 0.6,
                update: function (event, ui) {
                    methodPositionsCorrect()
                    /*
                    $(this).find('> li').each(function (index, element) {
                        $(this).find('input[name="item[' + $(this).attr('data-id') + '][position]"]').val(index + 1);
                    });
                    */
                }
            }).disableSelection();
            //$( "#sortable" ).disableSelection();
        });

        $('.method-delete').on('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                $(this).closest('li[data-id]').remove();
                methodPositionsCorrect()
            }
            e.returnValue = false;
            return false;
        });

        function methodPositionsCorrect() {
            return;

            $('#sortable > li').each(function (index, element) {
                $(this).find('input[name="method[' + $(this).attr('data-id') + '][position]"]').val(index + 1);
            });
        }
    </script>
@endpush
