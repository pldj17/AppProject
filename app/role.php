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
}
