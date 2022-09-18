<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
    </url>
    @foreach($pages as $page)
        <url>
            <loc>{{ $page->permalink() }}</loc>
        </url>
    @endforeach
    @foreach($articles as $article)
        <url>
            <loc>{{ $article->permalink() }}</loc>
        </url>
    @endforeach
    @foreach($categories as $category)
        <url>
            <loc>{{ $category->permalink() }}</loc>
        </url>
    @endforeach
    @foreach($tags as $tag)
        <url>
            <loc>{{ $tag->permalink() }}</loc>
        </url>
    @endforeach
    @foreach($users as $user)
        <url>
            <loc>{{ $user->permalink() }}</loc>
        </url>
    @endforeach
</urlset>
