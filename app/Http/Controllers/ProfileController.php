<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
// use ProjectApp\Http\Requests\ProfileRequest;
// use ProjectApp\Http\Requests\PasswordRequest;
use ProjectApp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Profile;
use Image;
use ProjectApp\Photo;
use ProjectApp\Post;

class ProfileController extends Controller
{
  
    use ResetsPasswords;

    //evita que se pueda acceder al perfil sin iniciar sesion
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function index(Request $request)
    {
        // $post = Post::orderBy('id')->pluck('description', 'id')->toArray();
        // dd($post);
        $photo = photo::with('post')->orderBy('id','desc')->get()->groupBy('post_id');
        // dd($photo);
        $profiles = Profile::all(); //consulta todos los perfiles creados y los trae
        return view('profile.index', compact('profiles', 'photo', 'post')); //compact genera una array con la informacion que le asignemos
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function AvatarUpload(Request $request)
    {
        $status = "";
        
        $this->validate($request, [
            'avatar' => 'required|mimes:png,jpeg,jpg'
        ]);

        $user_id = auth()->user()->id;


        if($request->hasfile('avatar'))
        {
            $image = $request->file('avatar');
            $ext = $image->guessExtension();
            $filename = time().'.'.$ext;

            $path = $request->file('avatar')->storeAs(
                'profile_pictures', $filename
            );

            $status = "uploaded"; 

            Profile::where('user_id', $user_id)->update([
                'avatar' => $filename
            ]);

        }        
        
        return response($status,200);
        // return redirect()->back()->with('message', 'Su foto de perfil ha sido actualizado!');
    }

    // public function avatar(Request $request)
    // { 
    //     $this->validate($request, [
    //         'avatar' => 'required|mimes:png,jpeg,jpg'
    //     ]); 

    //     $user_id = auth()->user()->id;

    //     if($request->hasfile('avatar'))
    //     {
    //         $file = $request->file('avatar'); 
    //         $ext = $file->getClientOriginalExtension();
    //         $filename = time().'.'.$ext; 
    //         // $file->move('uploads/avatar/', $filename); 
            
    //         Image::make($file)->resize(300, 300)->save(public_path('uploads/avatar/' . $filename));

    //         Profile::where('user_id', $user_id)->update([
    //             'avatar' => $filename
    //         ]);
    
    //         return redirect()->back()->with('message', 'Su foto de perfil ha sido actualizado!');
    //     }
    // }
  
    public function info()
    {
        return view('profile.info');
    }

    public function contact()
    {
        return view('profile.contact');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    { 
        $this->validate($request,[
            
            'phone' => 'numeric|required|min:11111|max:9999999999',
            'address' => 'required',
            'description' => 'required|min:20'
        ]); 
         
        $user_id = auth()->user()->id; 
        Profile::where('user_id', $user_id)->update([
            
            'phone' => request('phone'),
            'address' => request('address'),
            'description' => request('description')
        ]);

        return redirect()->back()->with('mensaje', 'Su perfil ha sido actualizado correctamente');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        return view('profile.ajustes');

        auth()->user()->update($request->all());

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function password(Request $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->with('mensaje', 'Su perfil ha sido actualizado correctamente.');
    }

    public function destroy($id)
    {
        //
    }
}
