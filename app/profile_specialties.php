<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class profile_specialties extends Model
{
    protected $table = "profile_specialty";
    protected $fillable = ['profile_id', 'specialty_id'];
    protected $guarded = ['id'];
}
