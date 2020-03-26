<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;

class Profile extends Model
{

    // protected $table = 'profiles';
    // protected $fillable = ['private', 'description', 'phone', 'correo', 'avatar', 'date_born', 'address_address',
    //                        'address_latitude', 'address_longitude'];
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // public function favorite_to_users()
    // {
    //     return $this->belongsToMany(User::class, 'favorites', 'profile_id', 'user_id' )->withTimestamps();
    // }

}
