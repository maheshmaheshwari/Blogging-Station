<?php
$widget = array_merge([
    'title' => '',
    'period' => '',
    'num' => 5,
    'class' => '',
], $widget);
?>

<?php
/**
 * @var \App\User $user
 */
$username = request()->route()->parameter('username');
if ($username) {
    $user = \App\User::whereUsername($username)->first();
}
?>
@if(isset($user) && $user)
    <?php
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
            'article.user',
        ])
        ->whereHas('article', function ($query) {
            /**
             * @var \Illuminate\Database\Eloquent\Builder $query
             */
            $query->whereIn('status', [1, 4]);
        })
        ->select([\DB::raw('count(article_id) as views'), 'article_id'])
        ->where('user_id', $user->id);

    if ($from && $to) {
        $popular_articles = $popular_articles->whereBetween('created_at', [$from, $to]);
    }

    $popular_articles = $popular_articles
        ->orderByDesc('views')
        ->groupBy('article_id')
        ->limit($widget['num'])
        ->get();
    ?>

    <div class="widget">
        <div class="block-header">
            <div class="block-title"><span>{{ $widget['title'] }}</span></div>
        </div>
        <div class="block-content">
            @foreach($popular_articles as $popular_article)
                <div class="block-item">
                    <div class="block-item-img img-side">
                        <a href="{{ $popular_article->article->permalink() }}"
                           style="background-image: url('{{ $popular_article->article->getMainImage('thumbnail') }}')"></a>
                    </div>
                    <div class="block-item-title">
                        <a href="{{ $popular_article->article->permalink() }}">
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
@endif
