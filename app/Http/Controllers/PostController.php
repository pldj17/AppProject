<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Requests\ActualizarPost;
use ProjectApp\Photo;
use ProjectApp\Post;

class PostController extends Controller
{
    private $userPhotosFolder = "photos";

    public function index()
    {
        //
    }

    public function create(array $data)
    {
        $post = Post::create([
            'name' => $data['description']
        ]);

        Photo::create([
            'post_id' => $post->id
        ]);

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

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Post::destroy($id)) {
                return response()->json(['mensaje' => 'ok']);
            } else {
                return response()->json(['mensaje' => 'ng']);
            }
        } else {
            abort(404);
        }
        return redirect()->route('profile.index');
    }
}
