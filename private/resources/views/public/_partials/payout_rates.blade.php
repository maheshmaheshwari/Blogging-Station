<?php
$payout_rates = unserialize(get_option_db('payout_rates'));
$countries = get_countries(true);
uasort($payout_rates, function ($a, $b) {
    if (!isset($a[1]) || !isset($b[1])) {
        return 0;
    }
    if ($a[1] == $b[1]) {
        return 0;
    }

    return ($a[1] < $b[1]) ? 1 : -1;
});
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icon-css@3.4.2/css/flag-icon.min.css"/>
<style>
    #payout-rates .flag-icon {
        width: 3em;
        line-height: 2.25em;
    }

    #payout-rates td, #payout-rates th {
        vertical-align: middle;
    }
</style>

<table id="payout-rates" class="table table-responsive-sm table-hover table-striped">
    <thead class="thead-light">
    <tr>
        <th>{{ __('Country') }}</th>
        <th>{{ __('Earnings per 1000 Views') }}</th>
    </tr>
    </thead>
    @foreach($payout_rates as $key => $value)
        <?php
        if (empty($value[1])) {
            continue;
        } ?>
        <tr>
            <td>
                <span class="flag-icon flag-icon-{{ strtolower($key) }}"></span> {{ $countries[$key] }}
            </td>
            <td>
                <?= display_price_currency($value[1]) ?>
            </td>
        </tr>
    @endforeach
</table>
