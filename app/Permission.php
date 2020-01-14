<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "permissions";
    protected $fillable = ['name', 'slug'];
    protected $guarded = ['id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
