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

}
