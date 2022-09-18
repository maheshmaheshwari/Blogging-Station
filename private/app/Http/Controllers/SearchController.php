<?php

namespace App\Http\Controllers;

use App\Article;

class SearchController extends Controller
{
    public function index()
    {
        $keyword = request()->get('q');

        if ($keyword) {
            $articles = Article::query()
                ->with(['user', 'mainCategory'])
                ->whereIn('status', [1, 4])
                ->whereRaw("MATCH(title, summary, content) AGAINST (? IN NATURAL LANGUAGE MODE)", [$keyword])
                ->paginate(10);

            /*
            $keyword = str_replace(['<', '>'], '', strip_tags($keyword));
            $articles = Article::query()
                ->with(['user', 'mainCategory'])
                ->selectRaw("*, MATCH(title, summary, content) AGAINST (? IN BOOLEAN MODE) AS score", [$keyword])
                ->whereIn('status', [1, 4])
                ->whereRaw("MATCH(title, summary, content) AGAINST (? IN BOOLEAN MODE)", [$keyword])
                ->orderBy('score', 'desc')
                ->paginate(10);
            */

            /*
            $articles = Article::query()
                ->with(['user', 'mainCategory'])
                ->whereIn('status', [1, 4])
                ->where(function ($query) use ($keyword) {
                    // @var \Illuminate\Database\Eloquent\Builder $query
                    $query->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('summary', 'like', '%' . $keyword . '%')
                        ->orWhere('content', 'like', '%' . $keyword . '%');
                })
                ->orderBy('published_at', 'desc')
                ->paginate(10);
            */
        }

        return view('public.search.index', [
            'keyword' => $keyword,
            'articles' => (isset($articles)) ? $articles : null,
        ]);
    }
}
