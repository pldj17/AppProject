<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use ProjectApp\Favorite;
use ProjectApp\Profile;
use ProjectApp\Specialty;
use ProjectApp\User;

class FavoritesController extends Controller
{
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

    public function show($id)
    {
        $perfil = Auth::user()->favorite_profiles;

        $especialidad = profile::with('especialidades')->get();
        // dd($perfil);

        $favs = Favorite::where('user_id', auth()->user()->id)->get();

        // dd($favs);

        return view('profile.favorites.favorite', compact('favs', 'perfil', 'especialidad'));
    }
}
