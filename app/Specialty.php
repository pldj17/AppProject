<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['name'];
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'specialty_user', 'user_id', 'specialty_id');
    }
}
