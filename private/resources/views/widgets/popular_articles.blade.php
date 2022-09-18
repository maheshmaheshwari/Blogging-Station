<?php
$widget = array_merge([
    'title' => '',
    'auto' => '',
    'cats' => [],
    'tags' => [],
    'period' => '',
    'num' => 5,
    'class' => '',
], $widget);

$from = null;
$to = null;

if ($widget['period'] === 'week') {
    $from = now()->subWeek()->startOfDay()->format('Y-m-d H:i:s');
    $to = now()->endOfDay()->format('Y-m-d H:i:s');
}

if ($widget['period'] === 'month') {
    $from = now()->subMonth()->startOfDay()->format('Y-m-d H:i:s');
    $to = now()->endOfDay()->format('Y-m-d H:i:s');
}

if ($widget['period'] === 'year') {
    $from = now()->subYear()->startOfDay()->format('Y-m-d H:i:s');
    $to = now()->endOfDay()->format('Y-m-d H:i:s');
}

$popular_articles = \App\Statistic::query()
    ->with([
        'article',
        'article.featuredImage',
        //'article.getMainCategory()',
        'article.user',
        'article.categories',
        'article.tags',
    ])
    ->whereHas('article', function ($query) {
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query->whereIn('status', [1, 4]);
    });

//        $popular_articles = $popular_articles->whereHas('article.categories', function ($query) {
//            /**
//             * @var \Illuminate\Database\Eloquent\Builder $query
//             * @var \App\Category $category
//             */
//            $category = request()->route()->parameter('category');
//            if (request()->route()->getName() === 'category.show' && $category) {
//                $query->where('category_id', $category->id);
//            }
//        });

$auto = (bool)$widget['auto'];
$category = request()->route()->parameter('category');
$tag = request()->route()->parameter('tag');
$routeName = request()->route()->getName();

if ($auto && $routeName === 'category.show' && $category) {
    $popular_articles = $popular_articles->whereHas('article.categories', function ($query) use ($category) {
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query->where('id', $category->id);
    });
} else {
    if (isset($widget['cats']) && count($widget['cats'])) {
        $popular_articles = $popular_articles->whereHas('article.categories', function ($query) use ($widget) {
            /**
             * @var \Illuminate\Database\Eloquent\Builder $query
             */
            $query->whereIn('id', $widget['cats']);
            $query->where('status', 1);
        });
    }
}

if ($auto && $routeName === 'tag.show' && $tag) {
    $popular_articles = $popular_articles->whereHas('article.tags', function ($query) use ($tag) {
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query->where('id', $tag->id);
    });
} else {
    if (isset($widget['tags']) && count($widget['tags'])) {
        $popular_articles = $popular_articles->whereHas('article.tags', function ($query) use ($widget) {
            /**
             * @var \Illuminate\Database\Eloquent\Builder $query
             */
            $query->whereIn('id', $widget['tags']);
            $query->where('status', 1);
        });
    }
}

$popular_articles = $popular_articles->select([\DB::raw('count(article_id) as views'), 'article_id']);

if ($from && $to) {
    $popular_articles = $popular_articles->whereBetween('created_at', [$from, $to]);
}

$popular_articles = $popular_articles->orderByDesc('views')
    ->groupBy('article_id')
    ->limit($widget['num'])
    ->get();
?>

<div class="widget {{ $widget['class'] }}">
    <div class="block-header">
        <div class="block-title"><span>{{ $widget['title'] }}</span></div>
    </div>
    <div class="block-content">
        @foreach($popular_articles as $popular_article)
            <div class="block-item">
                <div class="block-item-img img-side">
                    <a href="{{ route('article.show', ['slug' => $popular_article->article->slug, 'article' => $popular_article->article->id]) }}"
                       style="background-image: url('{{ $popular_article->article->getMainImage('thumbnail') }}')"></a>
                </div>
                <div class="block-item-title">
                    <a href="{{ route('article.show', ['slug' => $popular_article->article->slug, 'article' => $popular_article->article->id]) }}">
                        {{ $popular_article->article->title }}
                    </a>
                </div>
                <div class="block-item-meta">
                    <small>
                        <i class="far fa-clock"></i> {{ display_date_timezone($popular_article->article->published_at) }}
                    </small>
                    -
                    <small><i class="far fa-user"></i> {{ $popular_article->article->user->name }}</small>
                </div>
            </div>
        @endforeach
    </div>
</div>
