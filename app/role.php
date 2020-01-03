<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;

class role extends Model
{

    protected $table='roles';
    protected $fillable=['name','description'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
