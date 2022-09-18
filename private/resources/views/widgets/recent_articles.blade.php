<?php
$widget = array_merge([
    'title' => '',
    'cats' => [],
    'tags' => [],
    'num' => 5,
    'class' => '',
], $widget);

$recent_articles = \App\Article::query()
    ->with(['user', 'categories', 'tags', 'featuredImage']);

if (isset($widget['cats']) && count($widget['cats'])) {
    $recent_articles = $recent_articles->whereHas('categories', function ($query) use ($widget) {
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query->whereIn('id', $widget['cats']);
        $query->where('status', 1);
    });
}

if (isset($widget['tags']) && count($widget['tags'])) {
    $recent_articles = $recent_articles->whereHas('tags', function ($query) use ($widget) {
        /**
         * @var \Illuminate\Database\Eloquent\Builder $query
         */
        $query->whereIn('id', $widget['tags']);
        $query->where('status', 1);
    });
}

$recent_articles = $recent_articles
    ->whereIn('status', [1, 4])
    ->orderBy('published_at', 'desc')
    ->limit($widget['num'])
    ->get();
?>
<div class="widget">
    <div class="block-header">
        <div class="block-title"><span>{{ __('Recent Articles') }}</span></div>
    </div>
    <div class="block-content">
        @foreach($recent_articles as $article)
            <div class="block-item">
                <div class="block-item-img img-side">
                    <a href="{{ $article->permalink() }}"
                       style="background-image: url('{{ $article->getMainImage('thumbnail') }}')"></a>
                </div>
                <div class="block-item-title">
                    <a href="{{ $article->permalink() }}">
                        {{ $article->title }}
                    </a>
                </div>
                <div class="block-item-meta">
                    <small>
                        <i class="far fa-clock"></i> {{ display_date_timezone($article->published_at) }}
                    </small>
                    -
                    <small><i class="far fa-user"></i> {{ $article->user->name }}</small>
                </div>
            </div>
        @endforeach
    </div>
</div>
