<?php

namespace App\Http\Controllers;

use App\User;

class AuthorController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $username)
    {
        $user = User::whereUsername($username)->first();

        if (!$user) {
            abort(404);
        }

        if ($user->status !== 1) {
            abort(404);
        }

        $articles = $user->articles()
            ->with(['user', 'mainCategory'])
            ->whereIn('status', [1, 4])
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('public.authors.show', [
            'user' => $user,
            'articles' => $articles,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function feed(string $username)
    {
        $user = User::whereUsername($username)->first();

        if (!$user) {
            abort(404);
        }

        if ($user->status !== 1) {
            abort(404);
        }

        $articles = $user->articles()
            ->whereIn('status', [1, 4])
            ->orderByDesc('published_at')
            ->limit(15)
            ->get();

        return response()
            ->view('public.feed', [
                'info' => [
                    'title' => $user->username . ' - ' . get_option('site_name'),
                    'atom_link' => $user->feed(),
                    'description' => $user->description ?? get_option('site_description'),
                ],
                'articles' => $articles,
            ])
            ->header('Content-Type', 'application/rss+xml');
    }

    public function follow(string $username)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('danger', __('You need to login first.'));
        }

        $user = User::whereUsername($username)->first();
        if (!$user) {
            return redirect()->back()->with('danger', __('This author does not exist'));
        }

        if ($user->followers()->wherePivot('follower_id', auth()->user()->id)->exists()) {
            return redirect()->back()->with('danger', __('You are already following this author.'));
        }

        $user->followers()->attach(auth()->user()->id);
        return redirect()->back()->with('success', __('Successfully followed the user.'));
    }

    public function unFollow(string $username)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('danger', __('You need to login first.'));
        }

        $user = User::whereUsername($username)->first();
        if (!$user) {
            return redirect()->back()->with('danger', __('This author does not exist'));
        }

        $user->followers()->detach(auth()->user()->id);
        return redirect()->back()->with('success', 'Successfully unfollowed the user.');
    }
}
