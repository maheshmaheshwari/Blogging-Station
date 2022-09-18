<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @see https://laravel.com/docs/5.7/eloquent-mutators#attribute-casting
     *
     * @var array
     */
    protected $casts = [
        'widgets' => 'array',
    ];

    public $timestamps = false;

    public static function widgetTypes()
    {
        return [
            'recent_articles' => __('Recent Articles'),
            'popular_articles' => __('Popular Articles'),
            'recent_tweets' => __('Twitter Recent Tweets'),
            'newsletter' => __('Newsletter'),
            'author_about' => __('Author About'),
            'author_popular' => __('Author Popular Articles'),
            'ads' => __('Ads'),
            'follow_us' => __('Follow Us'),
            'html' => __('HTML & Javascript'),
        ];
    }

    /**
     * @param $widget array
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function widgetDisplay($widget)
    {
        if ($widget['type'] === 'popular_articles') {
            return view('widgets.popular_articles', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'ads') {
            return view('widgets.ads', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'newsletter') {
            return view('widgets.newsletter', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'recent_articles') {
            return view('widgets.recent_articles', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'recent_tweets') {
            return view('widgets.recent_tweets', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'author_about') {
            return view('widgets.author_about', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'author_popular') {
            return view('widgets.author_popular', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'follow_us') {
            return view('widgets.follow_us', ['widget' => $widget])->render();
        }

        if ($widget['type'] === 'html') {
            return view('widgets.html', ['widget' => $widget])->render();
        }
    }

    public static function sidebarDisplay($id = null)
    {
        if (!$id) {
            return '';
        }

        $sidebar = self::query()->find($id);
        if (!$sidebar) {
            return '';
        }

        $html = '';

        foreach ($sidebar->widgets as $widget) {
            $html .= self::widgetDisplay($widget);
        }

        return $html;
    }
}
