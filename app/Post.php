<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['image', 'description'];

    //un perfil puede tener muchos post
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function getPhotoAttribute(): string 
    {
        return url('photos/' . $this->attributes['image']);
    }

}
