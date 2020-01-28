<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Gallery;
use ProjectApp\Http\Requests\ActualizarPost;

class GalleryController extends Controller
{

    public function index()
    {
    	$posts = Gallery::get();
    	return view('profile.gallery',compact('posts'));
    }

    public function upload(ActualizarPost $request)
    {
    	$file = $request->file('image');
        $description = $request->get('description');
        $filename = str_random(10) . '.' .$file->getClientOriginalExtension();
        
        $user = Auth::user();
        $post = new Gallery();
        $file->move($this->userPhotosFolder, $filename);// subimos al servidor
        
        $post->profile_id = $user->id; // Asociamos el post al usuario actual
        $post->image = $filename;
        $post->description = $description;
        $post->save();
        
        return redirect()->route('home');
    }

    public function destroy($id)
    {
    	Gallery::find($id)->delete();
    	return back()
    		->with('mensaje','Archivo eliminado correctamente.');	
    }
}
