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

    //un post puede pertenecer a un solo perfil
    // public function post()
    // {
    //     return $this->hasMany(Post::class);
    // }

    // public function especialidades()
    // {
    //     return $this->belongsToMany(Specialty::class);
    // }
}
