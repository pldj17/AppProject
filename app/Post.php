<?php

namespace ProjectApp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['description'];
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    //un post puede tener muchas fotos
    public function Photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    //un post puede pertenecer a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function comments_count($id=0){

        return Comment::where('post_id',$id)->get()->count();
    }

    

}
