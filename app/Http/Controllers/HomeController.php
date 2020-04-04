<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Favorite;
use ProjectApp\Photo;
use ProjectApp\Profile;
use ProjectApp\profile_specialties;
use ProjectApp\Rating;
use ProjectApp\Specialty;
use ProjectApp\User;

class HomeController extends Controller
{

    public function index(Request $request, user $user)
    {
        $esp_user = Specialty::with('profiles')->orderBy('id', 'desc')->get();
        
        $categories = Specialty::all();
        $users = User::with(['profile', 'rating'])->get();
        // ->paginate(5);

        $fav_user = Favorite::all('user_id');

        $address_address = $request->get('address_address');
        $name = $request->get('name');
        $profiles = Profile::where('private', 1)->with(['especialidades', 'user', 'ratings'])
                ->searchResults()
                ->paginate(9); 

        $contador = $profiles->count();

        // rating
        $rating = Rating::get('avg_rating')->groupBy('profile_id');
        $ratingCount = $rating->count();

        return view('dashboard', compact('profiles', 'users', 'especialidades', 'users', 'categories', 'contador', 
                    'fav_user', 'rating', 'ratingCount'));
    }

    public function show($id)
    {
        $photo = Photo::with('post')->orderBy('id','desc')->get()->where('user_id', $id)->groupBy('post_id');

        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::find($id);

        return view('profile.index', compact('perfil', 'user', 'photo'));
    }
}
