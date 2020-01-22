<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\role;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name', 'slug'];
    protected $guarded = ['id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    //Query Scope
    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); //%antes y despues significa cualquier palabra semejante antes o despues a la palabra que se esta buscando
        }
    }
}
