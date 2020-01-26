<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['photo', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
