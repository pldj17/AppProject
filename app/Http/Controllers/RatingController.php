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

        //rating realizado por usuario en sesion
        $RatingStar = Rating::get()->whereIn('user_id', auth()->user()->id, 'profile_id', $id);

        $allRatings = Rating::where('profile_id', $id)->get();

        $rating = Rating::get();

        //rating de todos los usuarios menos del usuario en sesion
        $R = Rating::where('profile_id', $id)->get();

        $countRatings = $R->count();

        $usuarios = profile::get();

        // dd($usuarios);

        return view('profile.rating.puntuar', compact('perfil', 'RatingStar', 'user', 'rating', 'ratingCount', 'avgStar', 'allRatings', 'countRatings', 'R', 'usuarios', 'rating'));
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
        $rating->title_rating = request('title_rating');
        $rating->description_rating = request('description_rating');
        $rating->save();

        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $perfil = Profile::all()->where('user_id', $id)->first();
        $data = Rating::findOrFail($id);  //findOrFail si no encuentra un registro manda el 404 a diferencia de find
        return view('profile.rating.puntuar', compact('data', 'perfil'));
    }

    public function update(Request $request, $id)
    {
        Rating::findOrFail($id)->update($request->all());
        return redirect('rating')->with('mensaje', 'Puntuación actualizada con exito');
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();

        return back();    
    }
}
