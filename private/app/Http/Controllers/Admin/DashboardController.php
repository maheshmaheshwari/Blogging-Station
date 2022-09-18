<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Statistic;

class DashboardController extends AdminController
{
    public function index()
    {
        $last_record = now();

        $first_record = Statistic::query()
            ->select('created_at')
            ->orderBy('created_at')
            ->first();

        if (!$first_record) {
            $first_record = now();
        } else {
            $first_record = $first_record->created_at;
        }

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

        $articles = Article::query()
            ->whereBetween('published_at', [$date1, $date2])
            ->where('status', 1)
            ->count();

        $popular_articles = Statistic::query()
            ->has('article')
            ->with([
                'article',
                'article.featuredImage',
                'article.user',
            ])
            ->select([\DB::raw('count(article_id) as views'), 'article_id'])
            ->whereBetween('created_at', [$date1, $date2])
            ->orderByDesc('views')
            ->groupBy('article_id')
            ->limit(10)
            ->get();

        $new_articles = Article::query()
            ->with([
                'featuredImage',
                'user',
            ])
            ->whereBetween('published_at', [$date1, $date2])
            ->where('status', 1)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'year_month' => $year_month,
            'CurrentMonthDays' => $CurrentMonthDays,
            'author_earnings' => array_sum(array_column($CurrentMonthDays, 'author_earnings')),
            'referral_earnings' => array_sum(array_column($CurrentMonthDays, 'referral_earnings')),
            'total_views' => array_sum(array_column($CurrentMonthDays, 'view')),
            'articles' => $articles,
            'popular_articles' => $popular_articles,
            'new_articles' => $new_articles,
        ]);
    }
}
