<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Requests\ValidarRating;
use ProjectApp\Profile;
use ProjectApp\Rating;
use ProjectApp\User;

class RatingController extends Controller
{
    public function index($id)
    {
        $perfil = Profile::with('especialidades')->where('user_id', $id)->first();
        $user = User::find($id);

        $rating = Rating::where('profile_id', $id)->get();
        $ratingCount = $rating->count();
        $a = Rating::get()->where('profile_id', $id);
        $avgStar = $a->avg('rating');

        //rating realizado por usuario en sesion
        $RatingStar = Rating::get()->whereIn('user_id', auth()->user()->id, 'profile_id', $id);

        $allRatings = Rating::where('profile_id', $id)->get();
       
        $rating = Rating::all()->where('profile_id', $id, 'user_id' != auth()->user()->id);
        $count = $rating->count();

        //rating de todos los usuarios menos del usuario en sesion
        $R = Rating::where('profile_id', $id)->get();

        $countRatings = $R->count();

        $usuarios = profile::get();

        // dd($rating);

        return view('profile.rating.puntuar', compact('perfil', 'RatingStar', 'user', 'rating', 'ratingCount', 'avgStar', 'allRatings', 'count', 'R', 'usuarios', 'rating'));
    }

    public function create()
    {
        //
    }

    public function store(ValidarRating $request, $id)
    {           
        $rating = new Rating();
        $rating->user_id = Auth::id();
        $rating->profile_id = request('profile_id');
        $rating->rating = request('rating');
        $rating->title_rating = request('title_rating');
        $rating->description_rating = request('description_rating');

        $rating->save();
        $all_rating = Rating::get()->where('profile_id', $id);
        $avg_rating = $all_rating->avg('rating');

        $rating->avg_rating = $avg_rating;

        $rating->save();

        return redirect()->back()->with('mensaje', 'Su puntuación se ha guardado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Rating::findOrFail($id);  //findOrFail si no encuentra un registro manda el 404 a diferencia de find
        return view('profile.rating.edit_rating', compact('data'));
    }

    public function update(ValidarRating $request, $id)
    {
        $rating = Rating::findOrFail($id);
        $rating->user_id = Auth::id();
        $rating->profile_id = request('profile_id');
        $rating->rating = request('rating');
        $rating->title_rating = request('title_rating');
        $rating->description_rating = request('description_rating');

        $rating->save();
        
        // $rating = Rating::findOrFail($id);
        // $all_rating = Rating::get()->where('profile_id', $id);
        // $avg_rating = $all_rating->avg('rating');

        // $rating->avg_rating = $avg_rating;
        // dd($all_rating);
        // $rating->save();

        // Rating::where('id', $id)->update([
        //     'rating' => request('rate'),
        //     'title_rating' => request('title_rating'),
        //     'description_rating' => request('description_rating'),
        //     'profile_id' => request('profile_id'),
        //     'user_id' => Auth::id()
        // ]);

        return redirect()->back()->with('mensaje', 'Puntuación actualizada con exito');
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();

        return back();    
    }
}
