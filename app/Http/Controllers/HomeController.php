<?php

namespace ProjectApp\Http\Controllers;

use ProjectApp\Profile;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $profiles = Profile::all(); 
        //dd(auth()->user()->name);
        return view('dashboard', compact('profiles'));
    }
}
