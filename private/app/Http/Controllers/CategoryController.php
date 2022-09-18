<?php

namespace App\Http\Controllers;

use App\Category;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug, Category $category)
    {
        //$category->load(['user', 'categories', 'tags']);

        if (!$category->status) {
            abort(404);
        }

        if ($slug !== $category->slug) {
            return redirect($category->permalink(), 301);
        }

        $articles = $category->articles()
            ->whereIn('status', [1, 4])
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('public.categories.show', [
            'category' => $category,
            'articles' => $articles,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function feed(string $slug, Category $category)
    {
        if (!$category->status) {
            abort(404);
        }

        if ($slug !== $category->slug) {
            return redirect($category->feed(), 301);
        }

        $articles = $category->articles()
            ->whereIn('status', [1, 4])
            ->orderByDesc('published_at')
            ->limit(15)
            ->get();

        return response()
            ->view('public.feed', [
                'info' => [
                    'title' => $category->name . ' - ' . get_option('site_name'),
                    'atom_link' => $category->feed(),
                    'description' => $category->description ?? get_option('site_description'),
                ],
                'articles' => $articles,
            ])
            ->header('Content-Type', 'application/rss+xml');
    }
}
