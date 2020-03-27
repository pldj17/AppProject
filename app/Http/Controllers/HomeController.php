<?php

namespace ProjectApp\Http\Controllers;

use ProjectApp\Favorite;
use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Specialty;
use ProjectApp\User;

class HomeController extends Controller
{

    public function index(user $user)
    {
        $esp_user = Specialty::with('users')->orderBy('id', 'desc')->get();
        
        $categories = Specialty::all();
        $users = User::with(['especialidades'])->get();

        $fav_user = Favorite::all('user_id');

        $profiles = Profile::where('private', 1)->with('user')->get(); 
        $contador = $profiles->count();
        
        // dd($profiles);
        return view('dashboard', compact('profiles', 'users', 'especialidades', 'users', 'categories', 'contador', 'fav_user'));
    }

    public function show($id)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }

    public function search()
    {
        $categories = Specialty::all();
        $users = User::with(['especialidades'])
        ->searchResults()
        ->paginate(9);

        $fav_user = Favorite::all('user_id');

        $profiles = Profile::where('private', 1)->with('user')->get(); 
        $contador = $profiles->count();
        
        // dd($profiles);
        return view('search', compact('profiles', 'users', 'especialidades', 'users', 'categories', 'contador', 'fav_user'));
    }
}
