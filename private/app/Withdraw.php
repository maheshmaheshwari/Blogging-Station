<?php

namespace App;

class Withdraw extends AppModel
{
    protected $guarded = ['id'];

    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
