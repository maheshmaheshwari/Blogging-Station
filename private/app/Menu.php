<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
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
        'items' => 'array',
    ];

    public $timestamps = false;

    public static function itemTypes()
    {
        return [
            'link' => __('Link'),
            'page' => __('Page'),
            'category' => __('Category'),
            'tag' => __('Tag'),
            'author' => __('Author'),
        ];
    }

    public function display($options = [])
    {
        $menuItems = $this->items;

        $options = array_merge([
            'ul_class' => '',
            'li_class' => '',
            'a_class' => '',
        ], $options);

        //$html = \Cache::remember('menu_' . $this->id, 1 * 24 * 60 * 60, function () use ($menuItems) {
        //return $html;
        //});

        $html = '<ul class="' . e($options['ul_class']) . '">';
        foreach ($menuItems as $menuItem) {
            $visibility = $menuItem['visibility'] ?? 'all';

            if (($visibility === 'all') ||
                (auth()->check() && $visibility === 'logged') ||
                (auth()->check() && user()->role === 'admin' && $visibility === 'admin') ||
                (!auth()->check() && $visibility === 'guest')
            ) {
                $html .= '<li class="' . e($options['li_class']) . ' ' . e($menuItem['class'] ?? '') . '">' .
                    '<a class="' . e($options['a_class']) . '" href="' . e($this->menuItemHref($menuItem)) . '">' .
                    '<span>' . e($menuItem['title']) . '</span>' .
                    '</a>' .
                    '</li>';
            }
        }
        $html .= '</ul>';

        return $html;
    }

    protected function menuItemHref($menuItem)
    {
        $type = $menuItem['type'];

        $href = url('/');

        if ($type === 'link' && !empty($menuItem['link'])) {
            $href = url($menuItem['link']);
        }
        if ($type === 'page' && !empty($menuItem['page'])) {
            $page = Page::find($menuItem['page']);
            if ($page) {
                $href = $page->permalink();
            }
        }
        if ($type === 'category' && !empty($menuItem['category'])) {
            $category = Category::find($menuItem['category']);
            if ($category) {
                $href = $category->permalink();
            }
        }
        if ($type === 'tag' && !empty($menuItem['tag'])) {
            $tag = Tag::find($menuItem['tag']);
            if ($tag) {
                $href = $tag->permalink();
            }
        }
        if ($type === 'author' && !empty($menuItem['author'])) {
            $author = Tag::find($menuItem['author']);
            if ($author) {
                $href = $author->permalink();
            }
        }
        return $href;
    }
}
