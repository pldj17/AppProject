<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;

class Profile extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings');
    }

    public function getRatingAttribute()
    {
        return $this->ratings->avg('rating');
    }

}
