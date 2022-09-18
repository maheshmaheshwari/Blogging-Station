<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function ref($username = null)
    {
        if (!$username) {
            return redirect('/');
        }

        $user = User::query()
            ->where('username', $username)
            ->where('status', 1)
            ->first();

        if (!$user) {
            return redirect('/');
        }

        setcookie('ref', $username, now()->addMonths(3)->timestamp, '/', '', false, true);

        return redirect('/');
    }
}
