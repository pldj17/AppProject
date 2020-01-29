<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Requests\ActualizarPost;
use ProjectApp\Post;

class PostController extends Controller
{
    private $userPhotosFolder = "photos";

    public function index()
    {
        $posts = Post::orderBy('id','DESC')->where('user_id', Auth::id())->paginate(10);
        return view('profile.gallery', compact('posts'));
    }

    public function create()
    {
        //
    }

    public function store(ActualizarPost $request)
    {
        $file = $request->file('image');
        $filename = str_random(10) . '.' .$file->getClientOriginalExtension();
        
        $post = new Post;
        $file->move($this->userPhotosFolder, $filename);// subimos al servidor

        $post->user_id = $request->get('user_id');
        $post->description = $request->get('description');
        $post->image = $filename;
        $post->save();

        return redirect()->route('perfil_post')->with('mensaje', 'Se guardaron los cambios');
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
