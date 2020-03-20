<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = "favorites";
    protected $fillable = ['profile_id', 'user_id'];
    protected $guarded = ['id'];

    public function perfiles()
    { 
        return $this->belongsToMany(Profile::class); 
    }
}
