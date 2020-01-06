<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name', 'slug'];
    protected $guarded = ['id'];

    // public function roles()
    // {
    //     return $this->belongsToMany(Rol::class, 'permiso_rol', 'permiso_id', 'rol_id');
    // }
}
