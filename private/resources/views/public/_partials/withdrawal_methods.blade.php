<?php
$withdrawal_methods = unserialize(get_option_db('withdrawal_methods'));
?>

<table class="table table-responsive-sm table-hover table-striped">
    <thead class="thead-light">
    <tr>
        <th>{{ __('Withdrawal Method') }}</th>
        <th>{{ __('Minimum Withdrawal Amount') }}</th>
    </tr>
    </thead>
    @foreach( $withdrawal_methods as $withdrawal_method)
        @if($withdrawal_method['status'] === "1")
            <tr>
                <td>
                    <img src="{{ asset($withdrawal_method['image']) }}" alt="{{ $withdrawal_method['name'] }}"
                         width="100" data-toggle="tooltip" data-placement="right"
                         title="{{ $withdrawal_method['name'] }}">
                </td>
                <td>{{ display_price_currency($withdrawal_method['amount']) }}</td>
            </tr>
        @endif
    @endforeach
</table>
