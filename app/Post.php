<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['description'];
    protected $guarded = ['id'];

    //un post puede tener muchas fotos
    public function Photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    //un post puede pertenecer a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getPhotoAttribute(): string 
    // {
    //     return url('photos/' . $this->attributes['image']);
    // }

}
