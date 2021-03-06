<?php

namespace ProjectApp;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use ProjectApp\Profile;
use ProjectApp\Role;
// use ProjectApp\LaravelFakeId\RoutesWithFakeIds;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    // use RoutesWithFakeIds;
    use SoftDeletes;
    use AuthenticableTrait;

    protected $fillable = [
        'name', 'email', 'password', 'device_token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    // public function especialidades()
    // {
    //     return $this->belongsToMany(Specialty::class);
    // }

    public function favorite_profiles()
    {
        return $this->belongsToMany(Profile::class, 'favorites')->withTimestamps();
    }

    public function rating()
    {
        return $this->belongsToMany(Profile::class, 'ratings', 'user_id', 'profile_id');
    }

    public function scopeSearchResults($query)
    {
        return $query
            ->when(request()->filled('search'), function($query) {
                $query->whereHas('profile', function($query) {
                    $search = request()->input('search');
                    $query->where('address_address', 'LIKE', "%$search%");
                        // ->orWhere('description', 'LIKE', "%$search%")
                        // ->orWhere('address_address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('category'), function($query) {
                $query->whereHas('especialidades', function($query) {
                    $query->where('id', request()->input('category'));
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
    public function post()
    {
        return $this->hasMany(post::class);
    }

    /**definir relacion con la tabla profile */
    public function profile()
    {
        return $this->hasOne(Profile::class); //esta relacion buscara en la tabla Profile una llave foranea con el nombre de user_id
    }

    //Query Scope
    public function scopeName($query, $name )
    {
        if($name){
            return $query->where('name', 'LIKE', "%$name%"); //%antes y despues significa cualquier palabra semejante antes o despues a la palabra que se esta buscando
        }
    }

}
