<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Http\Requests\ActualizarPost;
use ProjectApp\Photo;
use ProjectApp\Post;
use ProjectApp\Profile;
use ProjectApp\Rating;
use ProjectApp\User;

class PhotoController extends Controller
{

    public function index($id)
    {
        $user = User::find($id);

        if ( $user->active == 1 ){
            
            $post_id = Post::get()->where('user_id', $id);

            $publicacion = Post::with('photos')->where('user_id', $id)->get();

            $photo = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->get();

            $perfil = Profile::all()->where('user_id', $id)->first();

            $rating = Rating::where('profile_id', $id)->get();
            $ratingCount = $rating->count();
            $a = Rating::get()->where('profile_id', $id);
            $avgStar = $a->avg('rating');
            //  dd($publicacion);

            return view('profile.gallery', compact('perfil', 'user', 'photo', 'post_id', 'id', 'publicacion', 'rating', 'ratingCount', 'avgStar'));
        
        }else{
            return redirect()->route('home');
        }
    }

    public function upload(ActualizarPost $request, user $user)
    {
        $description = $request->get('description');
        $img = $request->file('file');
        
        // dd($description, $img);

        if(empty($description) && empty($img))
        {
            return redirect()->route('perfil', ['id' => Auth::user()->id])->with('error', 'Error al realizar la publicación');
        }
        else
        {    
        
            $post  = new Post();
            $post->description = $request->get('description');
            $post->user_id = $request->get('user_id');
            $post->save();

            $image_code = '';

            if(empty($request->file('file')))
            {
                $GuardarImg = new photo();
                // $GuardarImg->user_id = $request->get('user_id');
                $GuardarImg->post_id = $post->id;
                $GuardarImg->save();
                return redirect()->route('perfil', ['id' => Auth::user()->id])->with('mensaje', 'La publicación se realizó con éxito');
            }else 
            {
                $images = $request->file('file');
                foreach($images as $image)
                {
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $new_name);
                    $image_code .= '<div class="col-md-3" style="margin-bottom:24px;"><img src="/images/'.$new_name.'" class="img-thumbnail" /></div>';
                    
                    $GuardarImg = new photo();
                    $GuardarImg->file = $new_name;
                    // $GuardarImg->user_id = $request->get('user_id');
                    $GuardarImg->post_id = $post->id;
                    $GuardarImg->save();
                }
            }
        }  

        return redirect()->route('perfil', ['id' => Auth::user()->id])->with('mensaje', 'La publicación se realizó con éxito');
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
