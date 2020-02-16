<?php

namespace ProjectApp\Http\Controllers;

use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\User;

class HomeController extends Controller
{

    public function index()
    {
        $user = User::all();
        $profiles = Profile::with('user')->get(); 
        // dd($profiles);
        return view('dashboard', compact('profiles', 'user'));
    }

    public function show($id)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }
}
