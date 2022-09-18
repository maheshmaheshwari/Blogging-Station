<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Comment extends AppModel
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
        'article_id' => 'integer',
        'status' => 'integer',
        'parent_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id')->withDefault();
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with('replies')// nest through children
            ->orderBy('id');
    }

    public function activeReplies()
    {
        return $this->replies()->where('status', 1)->get();
    }
}
