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
    protected $comment;

    public function comment($comment_id)
    {
        if(Notification::where('comment_id', $comment_id)->update(['read_at' => date('Y-m-d H:i:s')])){
            
            dump(Comment::find($comment_id));

        }
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
        if($comment->save()){

            $noti = new Notification;
            $noti->comment_id = $comment->id;
            $noti->post_id     = $request->post('post_id');

            if($noti->save()){
                $url = route('noti_comment', $comment->id);
                $noti->toMultiDevice(User::all(), 'title', 'body', null, $url);    
            }

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
