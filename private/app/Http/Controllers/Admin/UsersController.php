<?php

namespace App\Http\Controllers\Admin;

use App\Mail\EmailVerify;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsersController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [];

        if (null !== request()->input('Filter')) {
            $filter_fields = [
                'id',
                'status',
                'disable_earnings',
                'username',
                'email',
                'login_ip',
                'register_ip',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['username', 'email'];

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

        $users = User::where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate(20);

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.users.index', [
            'users' => $users,
            'orderBy' => $orderBy,
        ]);
    }

    public function referrals()
    {
        $referrals = User::query()
            ->whereNotNull('referred_by')
            ->paginate(20);

        foreach ($referrals as $referral) {
            $referral->referred_by_username = User::find($referral->referred_by)->username;
        }

        return view('admin.users.referrals', [
            'referrals' => $referrals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'role',
            'status',
            'username',
            'email',
            'password',
        ]);

        $validator = Validator::make($data, [
            'role' => 'required',
            'status' => 'required',
            'username' => 'required|string|alpha_num|min:3|max:50|unique:users',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.users.create'))
                ->withErrors($validator)
                ->withInput();
        }

        if ((int)$data['status'] === 2) {
            $data['activation_key'] = sha1(str_random(40));
        }

        $data['password'] = Hash::make($data['password']);
        $data['author_earnings'] = price_database_format(get_option('signup_bonus', 0));

        $user = User::create($data);

        if ((int)$data['status'] === 2 && get_option('account_activate_email', 'yes') == 'yes') {
            Mail::send(new EmailVerify($user));
        }

        session()->flash('message', __('User added.'));

        return redirect()->route('admin.users.edit', [$user->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->only([
            'role',
            'status',
            'disable_earnings',
            'username',
            'email',
            'password',
            'name',
            'description',
            'author_earnings',
            'referral_earnings',
        ]);

        // TODO add the full validation rules
        $validator = Validator::make($data, [
            'role' => 'required',
            'status' => 'required',
            'username' => 'required|string|alpha_num|min:3|max:50|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.users.edit', [$user->id]))
                ->withErrors($validator)
                ->withInput();
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        session()->flash('message', 'The user updated.');

        return redirect(route('admin.users.edit', [$user->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->id === user()->id) {
            session()->flash('danger', __("You can't delete your account."));
            return redirect()->route('admin.users.index');
        }

        if ($user->delete()) {
            foreach ($user->articles as $article) {
                $article->categories()->detach();
                $article->tags()->detach();
                $article->delete();
            }
            $user->comments()->delete();
            $user->statistics()->delete();
            $user->socialProfiles()->delete();
            $user->withdraws()->delete();
            $user->followers()->detach();
            $user->followings()->detach();

            foreach ($user->files as $file) {
                $file_path = public_path($file->file);

                $file_info = pathinfo($file_path);

                @unlink($file_path);

                array_map(
                    'unlink',
                    (array)@glob($file_info['dirname'] . DS . $file_info['filename'] . "-*." . $file_info['extension'])
                );
            }
            $user->files()->delete();
        } else {
            session()->flash('danger', __('Unable to delete this user.'));
        }
        return redirect()->route('admin.users.index');
    }
}
