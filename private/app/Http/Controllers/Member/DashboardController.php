<?php

namespace App\Http\Controllers\Member;

use App\Article;
use App\Statistic;

class DashboardController extends MemberController
{
    public function index()
    {
        $last_record = now();

        $first_record = user()->created_at;

        $year_month = [];

        $last_month = now()->year($last_record->year)->month($last_record->month)->startOfMonth();
        $first_month = now()->year($first_record->year)->month($first_record->month)->startOfMonth();

        while ($first_month <= $last_month) {
            $year_month[$last_month->format('Y-m')] = $last_month->isoFormat('MMMM YYYY');

            $last_month->modify('-1 month');
        }

        if (request()->get('month') &&
            array_key_exists(request()->get('month'), $year_month)
        ) {
            $to_month = explode('-', request()->get('month'));
            $year = (int)$to_month[0];
            $month = (int)$to_month[1];
        } else {
            $current_time = now()->startOfMonth();

            $year = (int)$current_time->format('Y');
            $month = (int)$current_time->format('m');
        }

        $date1 = now()->createFromDate($year, $month, 01)->startOfMonth()->format('Y-m-d H:i:s');
        $date2 = now()->createFromDate($year, $month, 01)->endOfMonth()->format('Y-m-d H:i:s');

        $views = Statistic::query()
            ->selectRaw("DATE_FORMAT(created_at, '%d-%m-%Y') AS `day`")
            ->selectRaw("COUNT(id) AS `count`")
            ->selectRaw("SUM(author_earn) AS `author_earnings`")
            ->selectRaw("SUM(referral_earn) AS `referral_earnings`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', user()->id)
            ->where('reason', 1)
            ->groupBy('day')
            ->get();

        $CurrentMonthDays = [];

        $targetTime = now()->createFromDate($year, $month, 01)->startOfMonth();

        for ($i = 1; $i <= $targetTime->format('t'); $i++) {
            $CurrentMonthDays[$i . "-" . $month . "-" . $year] = [
                'view' => 0,
                'author_earnings' => 0,
                'referral_earnings' => 0,
            ];
        }

        foreach ($views as $view) {
            if (!$view['day']) {
                continue;
            }
            $day = now()->modify($view['day'])->format('j-n-Y');
            $CurrentMonthDays[$day]['view'] = $view['count'];
            $CurrentMonthDays[$day]['author_earnings'] = $view['author_earnings'];
            $CurrentMonthDays[$day]['referral_earnings'] = $view['referral_earnings'];
        }

        return view('member.dashboard', [
            'year_month' => $year_month,
            'CurrentMonthDays' => $CurrentMonthDays,
            'author_earnings' => array_sum(array_column($CurrentMonthDays, 'author_earnings')),
            'referral_earnings' => array_sum(array_column($CurrentMonthDays, 'referral_earnings')),
            'total_views' => array_sum(array_column($CurrentMonthDays, 'view')),
        ]);
    }
}
