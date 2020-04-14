<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function readComment(Request $r)
    {
        if($r->ajax() ){
            $noti = Notification::read();
            return view('read.readComment', compact('noti'));
        }
    }

    public function store(Request $request, User $user)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post('post_id');
        $comment->message = $request->post('message');
        $comment->perfil_post_id = $request->post('perfil_post_id');
        if($comment->save()){

            // $noti = new Notification;
            // $noti->comment_id = $comment->id;
            // $noti->post_id     = $request->post('post_id');

            // if($noti->save()){
            //     $url  = route('noti_comment', $comment->id);
            //     $noti->toMultiDevice(User::all(), 'AppProject', 'Nueva notificación', null, $url);    
            // }

            $noti = new Notification;
            $noti->comment_id = $comment->id;
            $noti->post_id    = $request->post('post_id');
            $noti->token      = $request->post('token_perfil');
            $noti->perfil_post_id = $request->post('perfil_post_id');
            $noti->user_id    = $user->id;

            if($noti->save()){
                $token      = $request->post('token_perfil');
                $url = route('noti_comment', $comment->id, $user->id);
                $noti->toSingleDevice($token, 'title', 'body', null, $url);    
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
