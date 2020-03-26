<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'profile_id', 'user_id', 'raiting'
    ];
}
