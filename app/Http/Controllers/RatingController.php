<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Profile;
use ProjectApp\Rating;
use ProjectApp\User;

class RatingController extends Controller
{
    public function index($id)
    {
        $perfil = Profile::all()->where('user_id', $id)->first();
        $user = User::with('especialidades')->find($id);

        $rating = Rating::where('profile_id', $id)->get();
        $ratingCount = $rating->count();
        $a = Rating::get()->where('profile_id', $id);
        $avgStar = $a->avg('rating');
        
        return view('profile.rating.puntuar', compact('perfil', 'user', 'rating', 'ratingCount', 'avgStar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
