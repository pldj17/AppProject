<?php

namespace ProjectApp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ProjectApp\Profile;
use ProjectApp\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // definir metodo para la relacion de muchos a muchos con la tabla role
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name',$roles)->first();
    }

    public function hasAnyRole($role){
        return null !== $this->roles()->where('name',$role)->first();
    }

    // public function authorizeRoles($roles)
    // {
    //     abort_unless($this->hasAnyRole($roles), 401);
    //     return true;
    // }

    // public function hasAnyRole($roles)
    // {
    //     if (is_array($roles)) {
    //         foreach ($roles as $role) {
    //             if ($this->hasRole($role)) {
    //                 return true;
    //             }
    //         }
    //     } else {
    //         if ($this->hasRole($roles)) {
    //             return true; 
    //         }   
    //     }
    //     return false;
    // }
    
    // public function hasRole($role)
    // {
    //     if ($this->roles()->where('name', $role)->first()) {
    //         return true;
    //     }
    //     return false;
    // }

    /**definir relacion con la tabla profile */
    public function profile()
    {
        return $this->hasOne(Profile::class); //esta relacion buscara en la tabla Profile una llave foranea con el nombre de user_id
    }
}
