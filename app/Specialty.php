<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['name', 'description'];
    protected $guarded = ['id'];
}