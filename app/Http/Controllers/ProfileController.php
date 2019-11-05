<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
// use ProjectApp\Http\Requests\ProfileRequest;
// use ProjectApp\Http\Requests\PasswordRequest;
use ProjectApp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use ProjectApp\Profile;

class ProfileController extends Controller
{

    use ResetsPasswords;

    //evita que se pueda acceder al perfil sin iniciar sesion
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::all(); //consulta todos los perfiles creados y los trae
        return view('profile.index', compact('profiles')); //compact genera una array con la informacion que le asignemos
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function avatar(Request $request)
    { 
        $this->validate($request, [
            'avatar' => 'required|mimes:png,jpeg,jpg'
        ]); 

        $user_id = auth()->user()->id;

        if($request->hasfile('avatar'))
        {
            $file = $request->file('avatar'); 
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext; 
            $file->move('uploads/avatar/', $filename);  
            Profile::where('user_id', $user_id)->update([
                'avatar' => $filename
            ]);
    
            return redirect()->back()->with('message', 'Su foto de perfil ha sido actualizado!');
        }
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'telefono' => 'numeric|required|min:11111|max:9999999999',
            'direccion' => 'required',
            'descripcion' => 'required|min:20'
        ]); 
         
        $user_id = auth()->user()->id; 
        Profile::where('user_id', $user_id)->update([
            'telefono' => request('telefono'),
            'direccion' => request('direccion'),
            'descripcion' => request('descripcion')
        ]);

        return redirect()->back()->with('message', 'Su perfil ha sido actualizado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Su perfil ha sido actualizado correctamente.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(Request $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Su contraseña ha sido actualizado correctamente.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
