<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";
    protected $fillable = ['file','post_id','user_id'];
    protected $guarded = ['id'];

    //una foto puede pertenecer a una publicacion
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //foto/s puede pertenecer a un solo usuario
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}

