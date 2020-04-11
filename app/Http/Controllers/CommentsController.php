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
            $token = 'dPortD2Ejqo:APA91bF_FiuL9ZBGP8DndiJjdSZ-Le7bf0fv1j3l68N7T64RNwdxixd98aUbH7XaCZyqDxsen2LUzROaGcTXfdvFmaAKGh7A7rx2abzOSV_M_nNp-ibr-PcJTfPrPT8A25_NA2nKE7Zf';
            $noti->toSingleDevice($token, 'title', 'body', null, null);    
            return redirect()->route('perfil', [$user->id]);  
        }
       
    }

    public function show($id, $post)
    {
        // dd($comment, $id);
 
        $perfil = Profile::with('especialidades')->where('user_id', $id)->first();
        $user = User::find($id);
        $post = Post::with('photos')->orderBy('id', 'desc')->where('user_id', $id)->where('id', $post)->get();
        $post_id = Post::where('user_id', $id)->get('id');
        $comments = Comment::whereIn('post_id', $post_id)->get();
        $count_comments = Comment::where('post_id', $post)->get()->count();

        // dd($post);

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
