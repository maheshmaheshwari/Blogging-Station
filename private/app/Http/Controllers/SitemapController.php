<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Page;
use App\Tag;
use App\User;

class SitemapController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->select(['id', 'slug'])
            ->where('status', 1)
            ->get();

        $tags = Tag::query()
            ->select(['id', 'slug'])
            ->where('status', 1)
            ->get();

        $pages = Page::query()
            ->select(['id', 'slug'])
            ->where('status', 1)
            ->get();

        $users = User::query()
            ->select(['username'])
            ->where('status', 1)
            ->get();

        $articles = Article::query()
            ->select(['id', 'slug'])
            ->whereIn('status', [1, 4])
            ->get();

        return response()
            ->view('public.sitemap', [
                'categories' => $categories,
                'tags' => $tags,
                'pages' => $pages,
                'users' => $users,
                'articles' => $articles,
            ])
            ->header('Content-Type', 'text/xml');
    }
}
