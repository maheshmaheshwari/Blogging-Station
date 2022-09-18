<?php
ob_start(function ($buffer) {
    return str_replace(array("\r\n", "\r", "\n", "\t", "  "), '', $buffer);
});

$google_fonts_embed = App\Option::where('name', 'embed_google_fonts')->first();
$google_fonts_embed = unserialize($google_fonts_embed->value);

foreach ($google_fonts_embed as &$google_font) {
    $google_font = str_replace(' ', '+', $google_font);
    $google_font = $google_font . ':100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
}
$google_fonts_embed_url = '//fonts.googleapis.com/css?family=' . implode('%7C', $google_fonts_embed);
?>
<link href="<?= $google_fonts_embed_url ?>" rel="stylesheet">
<style>
    @php
    $body_typography = (array)get_style('body_typography', []);
    $secondary_typography = (array)get_style('secondary_typography', []);
    @endphp
    :root {
        --primary-color: {{ get_style('primary_color', '#dd0009') }};
        --primary-font: "{{ $body_typography['font_family'] ?? 'Nunito' }}";
        --second-font: "{{ $secondary_typography['font_family'] ?? 'Roboto+Slab' }}";
        --link-color: {{ $body_typography['links_color'] ?? '#6f6f6f' }};
        --heading-color: #1c1c1c;
        --text-color: {{ $body_typography['color'] ?? '#616161' }};
        --subtext-color: #919191;
        --border-color: #e5e5e5;
    }

    body {
        font-weight: {{ $body_typography['font_weight'] ?? '400' }};
        font-size: {{ $body_typography['font_size'] ?? '14px' }};
        line-height: {{ $body_typography['line_height'] ?? '1.5' }};
        {!! html_background_css(get_style('body_bg', [])) !!}
    }

    .top-nav {
        {!! html_background_css(get_style('top_header_bg', [])) !!}
        {!! html_typography_css(get_style('top_header_typography', [])) !!}
    }

    .top-nav a {
        @if(get_style('top_header_typography', [])['links_color'])
           color: {{ get_style('top_header_typography', [])['links_color'] }};
        @endif
    }

    .header {
        {!! html_background_css(get_style('header_bg', [])) !!}
    }

    .navbar-main {
        {!! html_background_css(get_style('main_menu_bg', [])) !!}
    }

    .navbar-main .navbar-nav .nav-link {
        {!! html_typography_css(get_style('main_menu_typography', [])) !!}
    }
    .navbar-main .navbar-nav .nav-link:hover {
        @if(get_style('main_menu_typography', [])['links_color'])
               color: {{ get_style('main_menu_typography', [])['links_color'] }};
    @endif
}

    footer.footer {
    {!! html_background_css(get_style('footer_bg', [])) !!}
    {!! html_typography_css(get_style('footer_typography', [])) !!}
    }

    footer.footer a {
        @if(get_style('footer_typography', [])['links_color'])
               color: {{ get_style('footer_typography', [])['links_color'] }};
        @endif
    }

    footer.footer .block-title span {
        @if(get_style('footer_widget_title_color'))
              color: {{ get_style('footer_widget_title_color') }};
    @endif
    }

    .article-title {
        {!! html_typography_css(get_style('article_title_typography', [])) !!}
    }
    .article-title {
        @if(get_style('article_title_typography', [])['links_color'])
               color: {{ get_style('article_title_typography', [])['links_color'] }};
        @endif
    }

    .article-content {
    {!! html_typography_css(get_style('article_content_typography', [])) !!}
    }
    .article-content a {
        @if(get_style('article_content_typography', [])['links_color'])
               color: {{ get_style('article_content_typography', [])['links_color'] }};
        @endif
    }

    .page-title {
        {!! html_typography_css(get_style('page_title_typography', [])) !!}
    }
    .page-title a {
        @if(get_style('page_title_typography', [])['links_color'])
               color: {{ get_style('page_title_typography', [])['links_color'] }};
        @endif
    }

    .page-content {
        {!! html_typography_css(get_style('page_content_typography', [])) !!}
    }
    .page-content a {
        @if(get_style('page_content_typography', [])['links_color'])
               color: {{ get_style('page_content_typography', [])['links_color'] }};
        @endif
    }
    {!! get_style('global_css', '') !!}
</style>
<?php ob_end_flush(); ?>
