<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['name'];
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'specialty_user', 'user_id', 'specialty_id');
    }

    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); //%antes y despues significa cualquier palabra semejante antes o despues a la palabra que se esta buscando
        }
    }
}
