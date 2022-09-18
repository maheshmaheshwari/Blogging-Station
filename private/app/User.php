<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'disable_earnings' => 'integer',
        'referred_by' => 'integer',
        'social_networks' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function image()
    {
        return $this->belongsTo(File::class, 'image_id')->withDefault();
    }

    public function profileImage()
    {
        if (!$this->image->id) {
            $hash = md5(strtolower($this->email));

            return "//2.gravatar.com/avatar/{$hash}?s=150&amp;d=mm&amp;r=g";
        }

        return asset($this->image->thumbnail());
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function statistics()
    {
        return $this->hasMany(Statistic::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function socialProfiles()
    {
        return $this->hasMany(SocialProfile::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    /**
     * The third argument is the foreign key name of the model on which you are defining the relationship,
     * while the fourth argument is the foreign key name of the model that you are joining to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'author_id', 'follower_id')->withTimestamps();
    }

    /**
     * The third argument is the foreign key name of the model on which you are defining the relationship,
     * while the fourth argument is the foreign key name of the model that you are joining to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'author_id')->withTimestamps();
    }

    /**
     * Get the user's social network link.
     *
     * @param string $name
     * @return string
     */
    public function socialNetwork($name)
    {
        $links = $this->social_networks;

        return !empty($links[$name]) ? $links[$name] : '';
    }

    public function permalink()
    {
        return route('author.show', ['username' => $this->username]);
    }

    public function feed()
    {
        return route('author.feed', ['username' => $this->username]);
    }

    public function getMetaDescription()
    {
        $description = $this->description;

        return $description;

        //return $this->getTextChars($description, 160, true);
    }
}
