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
        // $perfiles = Profile::with('user', 'favorite_to_users')->where('user_id', $id)->get();
        // $users = user::with('profile', 'favorite_profiles')->where('id', $id)->get();

        // $profiles = Profile::where('user_id', $id)->with('user')->get();

        // $fav = Favorite::where('user_id', $id)->get();

        // $perfiles = DB::table('users')
        //     ->select('name')
        //     ->join('favorites', 'favorites.user_id', '=', 'users.id')
        //     ->get();
        
        // $fav = DB::table('favorites')
        //     ->select('profile_id')
        //     ->join('profiles', 'profiles.id', '=', 'favorites.profile_id')
        //     ->get();

        $perfil = Auth::user()->favorite_profiles;
        // $especialidad = Auth::profile()->user;

        $especialidad = user::with('especialidades')->get();
        //  dd($perfil, $especialidad);

        return view('profile.favorites.favorite', compact('perfiles', 'users', 'perfil', 'especialidad'));
    }
}
