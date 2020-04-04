<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Comment;
use ProjectApp\User;
use ProjectApp\Notification;
use ProjectApp\Post;
use ProjectApp\Profile;

class CommentsController extends Controller
{
    // protected $profile;

    public function index()
    {
        //
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
        // $comment->save();
        if($comment->save()){

            $noti = new Notification;
            $token = 'fnj-5Xe-ei8:APA91bHc-NCO2h-ZCxxE08RmITgw4dHXkz8TUC6VaG1ZpFgnLUTySS63JwlZY3Hlyd6V_60q5jPcXBN_4u8568hS55CUPDFyUHb0gnFNbRLLXFdx8uR1uxIzcp1AF4K0M2T9_BsTMrEy';
            $noti->toSingleDevice($token, 'title', 'body', null, null);


            return redirect()->route('perfil', [$user->id]);
           
            
        }
        return redirect()->route('perfil', [$user->id]);
    }

    public function show($id, $comment)
    {
        // dd($comment, $id);
 
        $perfil = Profile::with('especialidades')->where('user_id', $id)->first();
        $user = User::find($id);
        $post = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->get();
        $post_id = Post::where('user_id', $id)->get('id');
        $comments = Comment::whereIn('post_id', $post_id)->get();
        $count_comments = Comment::where('post_id', $comment)->get()->count();

        return view('profile.comments.show', compact('count_comments', 'user', 'perfil', 'post', 'comments'));

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
