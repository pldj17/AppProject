<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Comment;
use ProjectApp\Post;
use ProjectApp\Profile;
use ProjectApp\User;

class CommentsController extends Controller
{
    public function index()
    {
        // $photo = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->get();

        // $posts = Post::count();

        // $perfil = Profile::all()->where('user_id', $id)->first();
        // $user = User::with('especialidades')->find($id);

        // return view('profile.index', compact('perfil', 'user', 'photo', 'especialidad_usuario', 'posts', 'comments', 'count_comments'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request, User $user)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post('post_id');
        $comment->message = $request->post('message');
        // $comment->commented = date('Y-m-d H:i:s');
        $comment->save();

        return redirect()->route('perfil', [$user->id]);
    }

    public function show($comment)
    {

        $count_comments = Comment::where('post_id', $comment)->get()->count();

        return view('profile.comments.show', compact('count_comments'));

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();        
    }
}
