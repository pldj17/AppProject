<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class profile_specialties extends Model
{
    protected $table = "specialty_user";
    protected $fillable = ['user_id', 'specialty_id'];
    protected $guarded = ['id'];
    public $timestamps = false; //
}
