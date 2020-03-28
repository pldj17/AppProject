<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = "ratings";
    protected $fillable = ['raiting', 'profile_id', 'user_id'];
    protected $guarded = ['id'];

}
