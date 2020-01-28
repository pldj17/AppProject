<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;
use ProjectApp\Menu;
use ProjectApp\Permission;

class role extends Model
{

    protected $table='roles';
    protected $fillable=['name','description'];
    protected $guarded = ['id'];

    //un rol puede pertenecer a muchos usuarios
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    //Query Scope
    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); //%antes y despues significa cualquier palabra semejante antes o despues a la palabra que se esta buscando
        }
    }
}
