<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $fillable = ['description','image'];

    public function getPhotoAttribute(): string 
    {
        return url('photos/' . $this->attributes['image']);
    }

}
