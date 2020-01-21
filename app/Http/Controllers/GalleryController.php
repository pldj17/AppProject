<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Gallery;

class GalleryController extends Controller
{

    public function index()
    {
    	$images = Gallery::get();
    	return view('profile.gallery',compact('images'));
    }

    public function upload(Request $request)
    {
    	$this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $input['image']);


        $input['title'] = $request->title;
        Gallery::create($input);


    	return back()
    		->with('mensaje','Archivo actualizado correctamente.');
    }

    public function destroy($id)
    {
    	Gallery::find($id)->delete();
    	return back()
    		->with('mensaje','Archivo eliminado correctamente.');	
    }
}
