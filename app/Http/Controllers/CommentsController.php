<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Comment;
use ProjectApp\User;
use ProjectApp\Notification;

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
        $comment->commented = date('Y-m-d H:i:s');
       
        // if($comment->save()){

        //     $noti = new Notification;
        //     $token = 'djEvzJ9zMpQ:APA91bG1PQ-AfJLtSikGu1HocyxdzpyBo-8rzaAr9cMw9_0g5eH8ffFjI3YkimFpwbTZokCGIW6X5b3pR5YHb_3OXjC_-iO8068iTRPDWzjvuoxinNKn-vwYx9BCH2VpZYjgF5W7crKz';
        //     $noti->toSingleDevice($token, 'title', 'body', null, null);


        //     return redirect()->route('perfil', [$user->id]);
           
            
        // }

        

        // return redirect()->route('perfil', [$user->id]);
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
