<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $puntuaciones = [1,2,3,4,5];
        return view('profile.rating.puntuar', compact('perfil', 'puntuaciones', 'user', 'rating', 'ratingCount', 'avgStar'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $rating = new Rating();
        $rating->user_id = Auth::id();
        $rating->profile_id = request('profile_id');
        $rating->rating = request('rate');
        $rating->save();

        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
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
