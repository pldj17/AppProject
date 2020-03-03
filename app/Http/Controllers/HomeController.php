<?php

namespace ProjectApp\Http\Controllers;

use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Specialty;
use ProjectApp\User;

class HomeController extends Controller
{

    public function index(user $user)
    {
        // $esp_por_perfil = profile_specialties::all('id');

        // $perfil = profile_specialties::all()->first(); //condicional para mostrar perfiles solo si tienen alguna especialidad

        // $user_id = User::all()->pluck('id');

        // $especialidades = Specialty::all();
        
        // $user_id = profile_specialties::all('user_id');

        // $users = User::with('especialidades')
        //     ->searchResults()
        //     ->paginate(1);

        $categories = Specialty::all();
        $shops = User::with(['especialidades'])
            ->searchResults()
            ->paginate(9);

        // $user->paginate(4);

        $profiles = Profile::where('private', 0)->with('user')->get(); 
        // dd($especialidades, $users, $profiles);
        return view('dashboard', compact('profiles', 'users', 'especialidades', 'shops', 'categories'));
    }

    public function show($id)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }
}
