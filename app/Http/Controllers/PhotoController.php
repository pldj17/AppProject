<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Photo;
use ProjectApp\Post;

class PhotoController extends Controller
{

    public function index()
    {
        //  $photos = Photo::all()->where('user_id', Auth::id());
        //  return view('profile.gallery', compact('photos'));

        $photos = Photo::orderBy('id','DESC')->where('user_id', Auth::id())->paginate(10);
        return view('profile.gallery', compact('photos'));
    }

    public function upload(Request $request)
    {
        $post  = new Post();
        $post->description = $request->get('description');
        $post->save();

        $image_code = '';
        $images = $request->file('file');
        foreach($images as $image)
        {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/images/'.$new_name.'" class="img-thumbnail" /></div>';
            
            $GuardarImg = new photo();
            $GuardarImg->file = $new_name;
            $GuardarImg->user_id = $request->get('user_id');
            $GuardarImg->post_id = $post->id;
            $GuardarImg->save();
        }

        return redirect()->route('profile.index')->with('mensaje', 'Se guardaron los cambios');
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