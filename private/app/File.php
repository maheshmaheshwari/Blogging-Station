<?php

namespace App;

class File extends AppModel
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
        'size' => 'integer',
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function thumbnail()
    {
        $file = (string)$this->file;

        if (!$file) {
            return asset('assets/img/file.png');
        }

        $extension = (string)$this->extension;

        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            return asset('assets/img/file.png');
        }

        $pattern = "/(.*?)" . preg_quote('.' . $extension, '/') . "$/"; // Ex. .jpg
        $replacement = "$1-150x150.{$extension}";

        $file = preg_replace($pattern, $replacement, $file);
        return asset($file);
    }

    // https://github.com/WordPress/WordPress/blob/4.9.8/wp-admin/includes/image.php
}
