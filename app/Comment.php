<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user(){

		return $this->belongsTo(User::class);
	}
}
