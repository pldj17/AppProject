<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Requests\ActualizarPost;
use ProjectApp\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
    	return view('profile.gallery',compact('images'));
    }

    public function upload(Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $input['photo'] = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $input['photo']);


        $input['description'] = $request->description;
        Post::create($input);


    	return back()
    		->with('success','Image Uploaded successfully.');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
    	return back()
    		->with('mensaje','Archivo eliminado correctamente.');
    }
}
