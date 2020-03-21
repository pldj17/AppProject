<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "favorites";
    protected $fillable = ['profile_id', 'user_id'];
    protected $guarded = ['id'];

    // public function users()
    // { 
    //     return $this->belongsToMany(User::class, 'favorites', 'user_id', 'profile_id'); 
    // }
}
