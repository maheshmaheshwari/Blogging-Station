<?php

namespace App\Helpers;

class Elements
{
    /**
     * @param $content
     * @return string
     */
    public static function apply($content)
    {
        return hooks()->do_shortcode($content);
    }

    /**
     * @return void
     */
    public static function add()
    {
        /**
         * Article Blocks
         */
        hooks()->add_shortcode('block1', [self::class, 'block1']);
        hooks()->add_shortcode('block2', [self::class, 'block2']);
        hooks()->add_shortcode('block3', [self::class, 'block3']);
        hooks()->add_shortcode('block4', [self::class, 'block4']);
        hooks()->add_shortcode('block5', [self::class, 'block5']);
        hooks()->add_shortcode('block6', [self::class, 'block6']);
        hooks()->add_shortcode('block7', [self::class, 'block7']);

        /**
         * Article Sliders
         */
        hooks()->add_shortcode('slider1', [self::class, 'slider1']);

        /**
         * Article Grids
         */
        hooks()->add_shortcode('grid1', [self::class, 'grid1']);
        hooks()->add_shortcode('grid2', [self::class, 'grid2']);
        hooks()->add_shortcode('grid3', [self::class, 'grid3']);

        /**
         * Ads
         */
        hooks()->add_shortcode('ads', [self::class, 'ads']);
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function grid1($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'block_title' => 'no',
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 4,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.grid1', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function grid2($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 5,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.grid2', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function grid3($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 4,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.grid3', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block1($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 6,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block1', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block2($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 7,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block2', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block3($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 5,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block3', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block4($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 6,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block4', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block5($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 5,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block5', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block6($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 5,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block6', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function block7($attributes = [], $content = '')
    {
        $attributes = self::elementAttributes([
            'type' => 'recent', // recent, popular
            'cats' => '',
            'filter' => 'no',
            'tags' => '',
            'per_page' => 5,
            'order_by' => 'published_at',
            'order' => 'desc',
            'page' => '1',

            'summary_length' => '',

            'title' => '',
            'spinner_type' => '',
            'pagination' => 'numeric', // next-prev numeric
            'spinner' => 'spinner-4',

        ], $attributes);

        return view('elements.block7', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     * @param string $content
     *
     * @return string
     *
     * @throws \Throwable
     */
    public static function slider1($attributes = [], $content = '')
    {
        return view('elements.slider1', [
            'attributes' => $attributes,
            'content' => $content,
        ])->render();
    }

    /**
     * @param array $attributes
     *
     * @return string
     */
    public static function ads($attributes = [])
    {
        $attributes = self::elementAttributes([
            'id' => '',
        ], $attributes);

        if (request()->session()->has('VisitorStatus') && request()->session()->get('VisitorStatus') === 0) {
            return '';
        }

        $id = (int)$attributes['id'];

        $ad = \App\Ad::find($id);

        if (!$ad) {
            return '';
        }

        if ($ad->status === 1) {
            return '<div id="ad-' . $id . '" class="ad-element"><div class="ad-inner">' . $ad->code . '</div></div>';
        }

        return '';
    }

    /**
     * Combine user attributes with known attributes and fill in defaults when needed.
     *
     * The pairs should be considered to be all of the attributes which are
     * supported by the caller and given as a list. The returned attributes will
     * only contain the attributes in the $pairs list.
     *
     * If the $atts list has unsupported attributes, then they will be ignored and
     * removed from the final returned list.
     *
     * @see https://github.com/WordPress/WordPress/blob/4.9.8/wp-includes/shortcodes.php#L533
     *
     * @param array $pairs Entire list of supported attributes and their defaults.
     * @param array $atts User defined attributes in shortcode tag.
     *
     * @return array Combined and filtered attribute list.
     */
    public static function elementAttributes($pairs, $attributes)
    {
        $attributes = (array)$attributes;

        $out = [];
        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $attributes)) {
                $out[$name] = $attributes[$name];
            } else {
                $out[$name] = $default;
            }
        }

        return $out;
    }
}

// Register Elements(ShortCodes)
\App\Helpers\Elements::add();
