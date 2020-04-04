<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use ProjectApp\User;

class Profile extends Model
{

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function especialidades()
    {
        return $this->belongsToMany(Specialty::class, 'specialty_user', 'user_id', 'specialty_id');
    }

    public function ratings()
    {
        return $this->belongsToMany(User::class, 'ratings', 'user_id', 'profile_id');
    }

    public function getRatingAttribute()
    {
        return $this->ratings->avg('rating');
    }

    //Query Scope
    // public function scopeName($query, $address_address )
    // {
    //     if($address_address){
    //         return $query->where('address_address', 'LIKE', "%$address_address%"); 
    //     }
    // }

    public function scopeSearchResults($query)
    {
        return $query->where('private', 1)
            ->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    $query->where('address_address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('category'), function($query) {
                $query->whereHas('especialidades', function($query) {
                    $query->where('specialty_id', request()->input('category'));
                });
            });
    }
}
