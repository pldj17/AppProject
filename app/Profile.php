<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;

class Profile extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

}
