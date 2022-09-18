<?php

namespace App\Http\Controllers;

use App\Article;
use App\Option;

class HomeController extends Controller
{
    /**
     * Homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //request()->ajax();

        $homepage = \Cache::remember('homepage', 60, function () {
            return applyShortCodes(Option::where('name', 'homepage')->first()->value);
        });

        return view('public.home.index', [
            'content' => $homepage,
        ]);
    }

    public function feed()
    {
        $articles = Article::query()
            //->select(['id', 'slug'])
            ->whereIn('status', [1, 4])
            ->orderByDesc('published_at')
            ->limit(15)
            ->get();

        return response()
            ->view('public.feed', [
                'info' => [
                    'title' => get_option('site_name'),
                    'atom_link' => route('feed'),
                    'description' => get_option('site_description'),
                ],
                'articles' => $articles,
            ])
            ->header('Content-Type', 'application/rss+xml');
    }
}
