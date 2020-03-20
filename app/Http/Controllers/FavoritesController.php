<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Favorite;
use ProjectApp\Profile;

class FavoritesController extends Controller
{
    // public function saveFavorite($id)
    // { 
    //     $FavoriteId = Profile::find($id); 
    //     $FavoriteId->favorites()->attach(auth()->user()->id); 
    //     return\redirect()->back(); 
    // }
    
    // public function unsaveFavorite($id)
    // { 
    //     $FavoriteId = Profile::find($id); 
    //     $FavoriteId->favorites()->detach(auth()->user()->id); 
    //     return\redirect()->back(); 
    // }

    public function add($profile)
    {
        $user = Auth::user();
        $isFavorite = $user->favorite_profiles()->where('profile_id',$profile)->count();

        if ($isFavorite == 0)
        {
            $user->favorite_profiles()->attach($profile);
            return redirect()->back()->with('mensaje', 'Agregado a fav exitosamente');
        } else {
            $user->favorite_profiles()->detach($profile);
            return redirect()->back()->with('mensaje', 'Se removio de fav exitosamente');
        }
    }
}
