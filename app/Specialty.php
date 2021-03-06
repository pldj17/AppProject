<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['name'];
    protected $guarded = ['id'];

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'specialty_user', 'user_id', 'specialty_id');
    }

    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); 
        }
    }
}
