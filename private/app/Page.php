<?php

namespace App;

class Page extends AppModel
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
        'status' => 'integer',
    ];

    public function permalink()
    {
        return route('page.show', ['slug' => $this->slug]);
    }

    public function getMetaDescription()
    {
        $content = $this->content;

        return $this->getTextChars($content, 160, true);
    }
}
