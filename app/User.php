<?php

namespace ProjectApp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use ProjectApp\Profile;
use ProjectApp\Role;
// use ProjectApp\LaravelFakeId\RoutesWithFakeIds;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    // use RoutesWithFakeIds;
    
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Specialty::class);
    }

    //, 'profile_specialty', 'user_id', 'specialty_id'

    public function scopeSearchResults($query)
    {
        return $query->where('active', 1)
            ->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('description', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('especialidad'), function($query) {
                $query->whereHas('especialidades', function($query) {
                    $query->where('id', request()->input('especialidad'));
                });
            });
    }


    // definir metodo para la relacion de muchos a muchos con la tabla role
    //un usuario puede tener muchos roles
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

    public function setSession($roles)
    {
        Session::put([
            'usuario_id' => $this->id,
            'usuario_nombre' => $this->name
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

    //un usuario puede tener muchas fotos
    public function Photo()
    {
        return $this->hasMany(photo::class);
    }

    /**definir relacion con la tabla profile */
    public function profile()
    {
        return $this->hasOne(Profile::class); //esta relacion buscara en la tabla Profile una llave foranea con el nombre de user_id
    }

    public function favorite_profiles()
    {
        return $this->belongsToMany(Profile::class, 'favorites')->withTimestamps();
    }

    //Query Scope
    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); //%antes y despues significa cualquier palabra semejante antes o despues a la palabra que se esta buscando
        }
    }

}
