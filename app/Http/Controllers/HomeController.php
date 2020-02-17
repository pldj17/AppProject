<?php

namespace ProjectApp\Http\Controllers;

use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\User;

class HomeController extends Controller
{

    public function index()
    {
        $esp_por_perfil = profile_specialties::all('id');

        $perfil = profile_specialties::all()->first();

        $user = User::all();
        $profiles = Profile::with('user')->get(); 
        //  dd($perfil);
        return view('dashboard', compact('profiles', 'user', 'perfil'));
    }

    public function show($id)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }
}
