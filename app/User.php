<?php

namespace ProjectApp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use ProjectApp\Profile;
use ProjectApp\Role;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // definir metodo para la relacion de muchos a muchos con la tabla role
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }


    public function setSession($roles)
    {
        Session::put([
            'usuario_id' => $this->id,
            'nombre' => $this->name
        ]);
        if (count($roles) == 1) {
            Session::put(
                [
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['name'],
                ]
            );
        } else {
            Session::put('roles', $roles);
        }
    }

    /**definir relacion con la tabla profile */
    public function profile()
    {
        return $this->hasOne(Profile::class); //esta relacion buscara en la tabla Profile una llave foranea con el nombre de user_id
    }
}
