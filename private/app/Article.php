<?php

namespace App;

use App\Helpers\Image;

class Article extends AppModel
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
        'user_id' => 'integer',
        'pay_type' => 'integer',
        'price' => 'double',
        'paid' => 'boolean',
        'disable_earnings' => 'boolean',
        'status' => 'integer',
        'hits' => 'integer',
        'tmp_content' => 'object',
        'seo' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @see https://laravel.com/docs/5.7/eloquent-mutators#date-mutators
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
    ];

    protected $perPage = 20;

    public function featuredImage()
    {
        return $this->belongsTo(File::class, 'featured_image_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('main');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function activeComments()
    {
        return $this->comments()->where('status', 1)->orderBy('id')->get();
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }

    public function mainCategory()
    {
        return $this->belongsToMany(Category::class)->wherePivot('main', 1);
        //return $this->belongsTo(Category::class, 'main_category_id')->withDefault();
    }

    /**
     * @return \App\Category
     */
    public function getMainCategory()
    {
        if ($this->mainCategory->first()) {
            return $this->mainCategory->first();
        }

        return (new Category);
    }

    /**
     * @param int $count
     * @return AppModel[]|Article[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection|null
     */
    public function relatedArticles($count = 6)
    {
        $tags = $this->tags->pluck('id')->toArray();
        $tags = array_filter($tags);

        if (empty($tags)) {
            return null;
        }

        $articles = self::query()
            ->with(['user', 'categories', 'tags', 'featuredImage', 'mainCategory'])
            ->whereHas('tags', function ($query) use ($tags) {
                /**
                 * @var \Illuminate\Database\Eloquent\Builder $query
                 */
                $query->whereIn('id', $tags);
                $query->where('status', 1);
            })
            ->orderBy('published_at', 'desc')
            ->whereIn('status', [1, 4])
            ->limit($count)
            ->get();

        return $articles;
    }

    /**
     * @param array $args
     *      'cats'     => '',
     *      'tags'     => '',
     *      'per_page' => 6,
     *      'order_by' => 'published_at',
     *      'order'    => 'desc',
     *      'page'     => '',
     * @return \Illuminate\Pagination\Paginator|\Illuminate\Database\Eloquent\Builder|\App\Article[]
     */
    public static function getArticles(array $args = [])
    {
        $type = $args['type'];

        if ($type === 'recent') {
            $query = self::query();

            $query = $query->has('mainCategory')->with(['user', 'categories', 'tags', 'featuredImage', 'mainCategory']);

            if (isset($args['cats']) && trim($args['cats'])) {
                $query = $query->whereHas('categories', function ($query) use ($args) {
                    /**
                     * @var \Illuminate\Database\Eloquent\Builder $query
                     */
                    $cats = array_map(function ($value) {
                        return (int)trim($value);
                    }, explode(',', $args['cats']));

                    $cats = array_filter($cats);

                    if (!empty($cats)) {
                        /*
                        $query->Where('id', $cats[0]);
                        unset($cats[0]);

                        foreach ($cats as $cat) {
                            $query->orWhere('id', $cat);
                        }
                        */
                        $query->whereIn('id', $cats);
                        $query->where('status', 1);
                    }
                });
            }

            if (isset($args['tags']) && trim($args['tags'])) {
                $query = $query->whereHas('tags', function ($query) use ($args) {
                    /**
                     * @var \Illuminate\Database\Eloquent\Builder $query
                     */
                    $tags = array_map(function ($value) {
                        return (int)trim($value);
                    }, explode(',', $args['tags']));

                    $tags = array_filter($tags);

                    if (!empty($tags)) {
                        /*
                        $query->Where('id', $tags[0]);
                        unset($tags[0]);

                        foreach ($tags as $tag) {
                            $query->orWhere('id', $tag);
                        }
                        */
                        $query->whereIn('id', $tags);
                        $query->where('status', 1);
                    }
                });
            }

            $query = $query->orderBy($args['order_by'], $args['order'])
                ->whereIn('status', [1, 4])
                ->paginate($args['per_page']);

            return $query;
        }

        if ($type === 'popular') {
            $query = Statistic::query()
                ->with([
                    'article' => function ($query) {
                        /**
                         * @var \Illuminate\Database\Eloquent\Builder $query
                         */
                        $query->select(['id', 'status']);
                    },
                    //'article.featuredImage',
                    //'article.mainCategory',
                    //'article.user',
                    'article.categories',
                    'article.tags',
                ])
                ->whereHas('article', function ($query) {
                    /**
                     * @var \Illuminate\Database\Eloquent\Builder $query
                     */
                    $query->whereIn('status', [1, 4]);
                });

            if (isset($args['cats']) && trim($args['cats'])) {
                $query = $query->whereHas('article.categories', function ($query) use ($args) {
                    /**
                     * @var \Illuminate\Database\Eloquent\Builder $query
                     */
                    $cats = array_map(function ($value) {
                        return (int)trim($value);
                    }, explode(',', $args['cats']));

                    $cats = array_filter($cats);

                    if (count($cats)) {
                        /*
                        $query->Where('id', $cats[0]);
                        unset($cats[0]);

                        foreach ($cats as $cat) {
                            $query->orWhere('id', $cat);
                        }
                        */
                        $query->whereIn('id', $cats);
                        $query->where('status', 1);
                    }
                });
            }

            if (isset($args['tags']) && trim($args['tags'])) {
                $query = $query->whereHas('article.tags', function ($query) use ($args) {
                    /**
                     * @var \Illuminate\Database\Eloquent\Builder $query
                     */
                    $tags = array_map(function ($value) {
                        return (int)trim($value);
                    }, explode(',', $args['tags']));

                    $tags = array_filter($tags);

                    if (count($tags)) {
                        /*
                        $query->Where('id', $tags[0]);
                        unset($tags[0]);

                        foreach ($tags as $tag) {
                            $query->orWhere('id', $tag);
                        }
                        */
                        $query->whereIn('id', $tags);
                        $query->where('status', 1);
                    }
                });
            }

            $query = $query->select([\DB::raw('count(article_id) as views'), 'article_id']);

            $ids = $query->orderByDesc('views')
                ->groupBy('article_id')
                ->pluck('article_id')
                ->toArray();

            unset($query);
            $query = self::query();

            $query = $query->with(['user', 'categories', 'tags', 'featuredImage', 'mainCategory']);

            $query = $query->whereIn('id', $ids)
                ->orderByRaw(\DB::raw("FIELD(id, " . implode(',', $ids) . " )"))
                ->paginate($args['per_page']);

            return $query;
        }
    }

    public function permalink()
    {
        return route('article.show', ['slug' => $this->slug, 'article' => $this->id]);
    }

    public function getFinalContent()
    {
        $content = $this->content;

        $content = $this->insertAdAfterParagraph($content);

        $content = $this->contentMediaEmbed($content);

        return $content;
    }

    /*
     * YouTube
     * https://www.youtube.com/watch?v=_DayhpcMaVo
     * https://youtu.be/_DayhpcMaVo
     *
     * Vimeo
     * https://vimeo.com/259411563
     *
     * Dailymotion
     * https://www.dailymotion.com/video/x6xvvbp
     * https://dai.ly/x6xvvbp
     *
     * Twitter
     * https://twitter.com/netbeans/status/1064145033581010944
     *
     * SoundCloud
     * https://soundcloud.com/ayasobhi/hans-zimmer-maestro-the
     */
    protected function contentMediaEmbed($content)
    {
        $patterns = [
            "/<(p|div)>(https?:\/\/(www.|m.)?(youtube.com|youtu.be)\/(watch\?v=)?([a-zA-Z0-9\-_]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?vimeo.com\/([0-9]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?(dailymotion.com|dai.ly)\/(video\/)?([a-zA-Z0-9\-_]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?twitter.com\/([a-zA-Z0-9\-_]+)\/status\/([0-9]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?soundcloud.com\/([a-zA-Z0-9\-_]+)\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?instagram.com\/p\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.)?pinterest.com\/pin\/([a-zA-Z0-9\-_]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
            "/<(p|div)>(https?:\/\/(www.|m.)?facebook.com\/([a-zA-Z0-9\-_\.]+)\/(posts|photos|videos)\/([a-zA-Z0-9\-_\.]+)([a-zA-Z0-9#\/\*\-\_\?\&\;\%\=\.]*))<\/(p|div)>/i",
        ];

        $replace = [
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
            "<a class='embedly-card' data-card-controls='0' href='$2'>$2</a>",
        ];

        return preg_replace($patterns, $replace, $content);
    }


    protected function insertAdAfterParagraph($content)
    {
        $article_ads = get_style('ads_article_paragraphs', []);

        $ads = [];

        if (count($article_ads)) {
            foreach ($article_ads as $article_ad) {
                $p = (int)$article_ad['p'];
                $code = (int)$article_ad['code'];


                if ($p > 0 && $code > 0) {
                    $ads[] = [
                        'p' => $p,
                        'code' => applyShortCodes('[ads id="' . $code . '"]'),
                    ];
                }
            }
        }

        if (!count($ads)) {
            return $content;
        }

        $closing_p = '</p>';
        $paragraphs = explode($closing_p, $content);
        foreach ($paragraphs as $index => $paragraph) {
            $paragraphs[$index] .= $closing_p;

            foreach ($ads as $ad) {
                if ($ad['p'] === $index + 1) {
                    $paragraphs[$index] .= $ad['code'];
                }
            }

            /*
            if ($paragraph_id === $index + 1) {
                $paragraphs[$index] .= $insertion;
            }
            */
        }

        return implode('', $paragraphs);
    }

    public function tagsString()
    {
        $tags = $this->tags;

        $string = '';

        foreach ($tags as $tag) {
            $string .= '<a class="badge badge-pill badge-light" href="' . $tag->permalink() . '">' .
                $tag->name . '</a>';
        }

        return $string;
    }

    public function getMainImage($size = null)
    {
        $image = (string)$this->featuredImage->file;
        if (!$image) {
            return asset('assets/img/thumb.png');
        }

        $extension = (string)$this->featuredImage->extension;

        if (!$size) {
            return asset($image);
        }

        $sizes = Image::$sizes;

        $size = $sizes[$size] ?? $sizes['medium'];

        $pattern = "/(.*?)" . preg_quote('.' . $extension, '/') . "$/"; // Ex. .jpg
        $replacement = "$1-{$size[0]}x{$size[1]}.{$extension}";

        $image = preg_replace($pattern, $replacement, $image);

        return asset($image);
    }

    public function getMainImageHTML($size = null)
    {
        $src = (string)$this->featuredImage->file;

        /*
        $meta = $this->featuredImage->meta;

        $srcset = '';
        if (!empty($meta['sizes'])) {
            foreach ($meta['sizes'] as &$meta_size) {
                $w_h = $meta_size;

                $meta_size = asset(
                    str_replace(
                        ".",
                        "-{$w_h[0]}x{$w_h[1]}.",
                        $src
                    )
                );
                $meta_size .= ' ' . $w_h[0] . 'w';
            }
            $srcset .= 'srcset="';
            $srcset .= implode(', ', $meta['sizes']);
            $srcset .= '"';
        }
        */

        /*
        $image_info = pathinfo(public_path($src));

        $images = @glob($image_info['dirname'] . DS . $image_info['filename'] . "-*." . $image_info['extension']);

        foreach ($images as &$image) {
            $image = str_replace(public_path(), '', $image);
            if (preg_match("/-(?<width>\d+)x(?<height>\d+)./", $image, $matches)) {
                $image = asset($image) . ' ' . $matches['width'] . 'w';
            };
        }

        $srcset = 'srcset="';
        $srcset .= implode(', ', $images);
        $srcset .= '"';
        */

        if (is_integer($size)) {
            $size = [$size, $size];
        }

        if (is_array($size)) {
            $src = str_replace(".", "-{$size[0]}x{$size[1]}.", $src);
        }

        if (empty($src)) {
            $src = "//via.placeholder.com/{$size[0]}x{$size[1]}";
        }

        $html = '<img src ="' . asset($src) . '" alt="' . e($this->title) . '" width="' . $size[0] . '" ' .
            'height="' . $size[1] . '" />';

        return $html;
    }

    public function getMainImageBackground()
    {
        $html = "background-image: url('" . $this->getMainImage([370, 222]) . "');" .
            "background-image: -webkit-image-set(url('" . $this->getMainImage([370, 222]) . "') 1x," .
            "url('" . $this->getMainImage([740, 444]) . "') 2x);" .
            "background-image: -moz-image-set(url('" . $this->getMainImage([370, 222]) . "') 1x," .
            "url('" . $this->getMainImage([740, 444]) . "') 2x);" .
            "background-image: -o-image-set(url('" . $this->getMainImage([370, 222]) . "') 1x," .
            "url('" . $this->getMainImage([740, 444]) . "') 2x);" .
            "background-image: -ms-image-set(url('" . $this->getMainImage([370, 222]) . "') 1x," .
            "url('" . $this->getMainImage([740, 444]) . "') 2x);";

        $html = str_replace(["\r\n", "\r", "\n", "\t"], '', $html);

        return $html;
    }

    public function getMainImageRatio($ratio)
    {
        /*
        $src = (string)$this->featuredImage->file;

        $image_info = pathinfo(public_path($src));

        $images = @glob($image_info['dirname'] . DS . $image_info['filename'] . "-*." . $image_info['extension']);

        foreach ($images as &$image) {
            $image = str_replace(public_path(), '', $image);
            if (preg_match("/-(?<width>\d+)x(?<height>\d+)./", $image, $matches)) {
                $image = asset($image) . ' ' . $matches['width'] . 'w';
            };
        }

        return $image;
        */
    }

    public function getSummary($length = null)
    {
        $summary = $this->summary;

        return $this->getTextWords($summary, $length);
    }

    public function getMetaDescription()
    {
        $summary = $this->summary;

        return $this->getTextChars($summary, 160);
    }
}
