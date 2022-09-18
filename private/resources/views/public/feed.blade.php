<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder|\App\Article[] $articles
 */
?>
<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
>
    <channel>
        <title>{{ $info['title'] }}</title>
        <atom:link href="{{ $info['atom_link'] }}" rel="self" type="application/rss+xml"/>
        <link>{{ url('/') }}</link>
        <description><![CDATA[{{ $info['description'] }}]]></description>
        <language>{{ get_option('language') }}</language>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>1</sy:updateFrequency>
        @foreach($articles as $article)
            <item>
                <title><![CDATA[{!! $article->title !!}]]></title>
                <link>{{ $article->permalink() }}</link>
                <pubDate>{{ $article->created_at->format(DateTime::RSS) }}</pubDate>
                <guid>{{ $article->permalink() }}</guid>
                <description><![CDATA[{!! $article->summary !!}]]></description>
                <content:encoded><![CDATA[{!! $article->content !!}]]></content:encoded>
                <dc:creator><![CDATA[{{ $article->user->name }}]]></dc:creator>
                @foreach( $article->categories as $category)
                    <category><![CDATA[{!! $category->name !!}]]></category>
                @endforeach
            </item>
        @endforeach
    </channel>
</rss>
