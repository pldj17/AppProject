<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menus";
    protected $fillable = ['name', 'url', 'icon']; 
    protected $guarded = 'id'; //campos que laravel no permitira modificar
}
