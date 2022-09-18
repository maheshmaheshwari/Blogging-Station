<?php

namespace App\Http\Controllers\Member;

use App\Mail\AdminNewWithdrawal;
use App\User;
use App\Withdraw;
use Illuminate\Support\Facades\Mail;

class WithdrawController extends MemberController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $withdraws = Withdraw::with('user')
            ->where('user_id', auth()->id())
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        $total_withdrawn = Withdraw::query()
            ->selectRaw("SUM(amount) AS `total`")
            ->where('user_id', user()->id)
            ->where('status', 3)
            ->first();

        $pending_withdrawn = Withdraw::query()
            ->selectRaw("SUM(amount) AS `total`")
            ->where('user_id', user()->id)
            ->where('status', 2)
            ->first();

        return view('member.withdraws.index', [
            'withdraws' => $withdraws,
            'orderBy' => $orderBy,
            'total_withdrawn' => $total_withdrawn->total,
            'pending_withdrawn' => $pending_withdrawn->total,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        $user = User::find(auth()->id());

        $withdraw = new Withdraw;

        $withdraw->user_id = $user->id;
        $withdraw->status = 2;
        $withdraw->author_earnings = price_database_format($user->author_earnings);
        $withdraw->referral_earnings = price_database_format($user->referral_earnings);
        $withdraw->amount = price_database_format($user->author_earnings + $user->referral_earnings);

        $method = $user->withdrawal_method;
        $account = $user->withdrawal_account;

        if ($method !== 'wallet' && (empty($method) || empty($account))) {
            session()->flash('danger', __('You should fill your withdrawal info from your profile settings.'));

            return redirect()->route('member.withdraws.index');
        }

        $withdrawal_methods = array_column(get_withdrawal_methods(), 'amount', 'id');

        if (!in_array($user->withdrawal_method, array_keys($withdrawal_methods))) {
            session()->flash('danger', __('Invalid withdrawal method.'));

            return redirect()->route('member.withdraws');
        }

        $minimum_withdrawal_amount = $withdrawal_methods[$user->withdrawal_method];

        if ($withdraw->amount < $minimum_withdrawal_amount) {
            session()->flash('danger', __(
                'Withdraw amount should be equal or greater than :amount.',
                ['amount' => display_price_currency($minimum_withdrawal_amount)]
            ));

            return redirect()->route('member.withdraws.index');
        }

        $withdraw->method = $method;
        $withdraw->account = $account;

        if ($withdraw->save()) {
            $user->author_earnings = 0;
            $user->referral_earnings = 0;
            $user->save();

            if ((bool)get_option('alert_admin_new_withdrawal', 1)) {
                if (!empty(get_option('admin_email'))) {
                    Mail::send(new AdminNewWithdrawal($withdraw));
                }
            }

            session()->flash('success', __('Your withdraw has been request and under review.'));
        } else {
            session()->flash('danger', __('Unable to request the withdraw.'));
        }

        return redirect()->route('member.withdraws.index');
    }
}
