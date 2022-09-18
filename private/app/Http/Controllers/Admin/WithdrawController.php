<?php

namespace App\Http\Controllers\Admin;

use App\Mail\MemberApprovedWithdrawal;
use App\Mail\MemberCanceledWithdrawal;
use App\Mail\MemberCompletedWithdrawal;
use App\Option;
use App\Statistic;
use App\Withdraw;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [];

        if (request()->input('Filter')) {
            $filter_fields = [
                'user_id',
                'status',
                'method',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = [];

                    if (in_array($param_name, $like_params)) {
                        $conditions[] = [$param_name, 'like', '%' . $param_value . '%'];
                    } else {
                        $conditions[] = [$param_name, '=', $param_value];
                    }
                }
            }
        }

        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $withdraws = Withdraw::with('user')
            ->where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        $authors_earnings = Withdraw::query()
            ->selectRaw("SUM(author_earnings) AS `total`")
            ->first();

        $referral_earnings = Withdraw::query()
            ->selectRaw("SUM(referral_earnings) AS `total`")
            ->first();

        $pending_withdrawn = Withdraw::query()
            ->selectRaw("SUM(amount) AS `total`")
            ->where('status', 2)
            ->first();

        $total_withdrawn = Withdraw::query()
            ->selectRaw("SUM(amount) AS `total`")
            ->where('status', 3)
            ->first();

        return view('admin.withdraws.index', [
            'withdraws' => $withdraws,
            'orderBy' => $orderBy,
            'authors_earnings' => $authors_earnings->total,
            'referral_earnings' => $referral_earnings->total,
            'pending_withdrawn' => $pending_withdrawn->total,
            'total_withdrawn' => $total_withdrawn->total,
        ]);
    }

    public function methods()
    {
        $withdrawal_methods = Option::whereName('withdrawal_methods')->first();

        if (request()->isMethod('post')) {
            if (request()->post('type') === 'new') {
                $current_methods = unserialize($withdrawal_methods->value);

                $current_methods[] = [
                    'name' => request()->post('name'),
                    'id' => request()->post('id'),
                    'status' => request()->post('status'),
                    'image' => request()->post('image'),
                    'amount' => request()->post('amount'),
                ];

                // use array_values to rest keys
                $withdrawal_methods->value = serialize(array_values($current_methods));

                $withdrawal_methods->update();
            }

            if (request()->post('type') === 'update') {
                $withdrawal_methods->value = serialize(array_values(request()->post('method')));
                $withdrawal_methods->update();
            }
        }

        return view('admin.withdraws.methods', [
            'withdrawal_methods' => unserialize($withdrawal_methods->value),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Withdraw $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        $pre_withdraw = Withdraw::query()
            ->where('created_at', '<', $withdraw->created_at)
            ->where('user_id', $withdraw->user_id)
            ->orderByDesc('created_at')
            ->first();

        $date1 = (!$pre_withdraw) ? '0000-00-00 00:00:00' : $pre_withdraw->created_at;
        $date2 = $withdraw->created_at;

        $reasons = Statistic::query()
            ->select('reason')
            ->selectRaw("COUNT(reason) AS `count`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', $withdraw->user_id)
            ->orderByDesc('count')
            ->groupBy('reason')
            ->get();

        $countries = Statistic::query()
            ->select('country')
            ->selectRaw("COUNT(country) AS `count`")
            ->selectRaw("SUM(author_earn) AS `author_earnings`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', $withdraw->user_id)
            ->where('reason', 1)
            ->orderByDesc('count')
            ->groupBy('country')
            ->get();

        $ips = Statistic::query()
            ->select('ip')
            ->selectRaw("COUNT(ip) AS `count`")
            ->selectRaw("SUM(author_earn) AS `author_earnings`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', $withdraw->user_id)
            ->where('reason', 1)
            ->orderByDesc('count')
            ->groupBy('ip')
            ->get();

        $referrers = Statistic::query()
            ->select('referer_domain')
            ->selectRaw("COUNT(referer_domain) AS `count`")
            ->selectRaw("SUM(author_earn) AS `author_earnings`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', $withdraw->user_id)
            ->where('reason', 1)
            ->orderByDesc('count')
            ->groupBy('referer_domain')
            ->get();

        $articles = Statistic::query()
            ->has('article')
            ->with('article')
            ->select('article_id')
            ->selectRaw("COUNT(article_id) AS `count`")
            ->selectRaw("SUM(author_earn) AS `author_earnings`")
            ->whereBetween('created_at', [$date1, $date2])
            ->where('user_id', $withdraw->user_id)
            ->where('reason', 1)
            ->orderByDesc('count')
            ->groupBy('article_id')
            ->get();

        return view('admin.withdraws.show', [
            'withdraw' => $withdraw,
            'countries' => $countries,
            'reasons' => $reasons,
            'ips' => $ips,
            'referrers' => $referrers,
            'articles' => $articles,
        ]);
    }

    public function approve(Withdraw $withdraw)
    {
        $withdraw->status = 1;

        if ($withdraw->update()) {
            if (!empty($withdraw->user->email)) {
                if ((bool)get_option('alert_member_approved_withdraw', 1)) {
                    Mail::send(new MemberApprovedWithdrawal($withdraw));
                }
            }

            session()->flash('success', 'The withdrawal request has been approved.');
        }

        return redirect()->back();
    }

    public function complete(Withdraw $withdraw)
    {
        $withdraw->status = 3;

        if ($withdraw->save()) {
            if (!empty($withdraw->user->email)) {
                if ((bool)get_option('alert_member_completed_withdraw', 1)) {
                    Mail::send(new MemberCompletedWithdrawal($withdraw));
                }
            }

            session()->flash('success', 'The withdrawal request has been completed.');
        }

        return redirect()->back();
    }

    public function cancel(Withdraw $withdraw)
    {
        $withdraw->status = 4;

        if ($withdraw->save()) {
            if (!empty($withdraw->user->email)) {
                if ((bool)get_option('alert_member_canceled_withdraw', 1)) {
                    Mail::send(new MemberCanceledWithdrawal($withdraw));
                }
            }

            session()->flash('success', 'The withdrawal request has been canceled.');
        }

        return redirect()->back();
    }
}
