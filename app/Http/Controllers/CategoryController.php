<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use ProjectApp\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.role.index')->with('roles',role::paginate(4)); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function destroy($id)
    {
        //
    }
}
