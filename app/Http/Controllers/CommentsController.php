<?php

namespace ProjectApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProjectApp\Comment;
use ProjectApp\User;
use ProjectApp\Notification;

class CommentsController extends Controller
{
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
        $comment->save();

        $noti = new Notification;
        $token = 'dKyIuQ6nW4U:APA91bHanH5jq9cRytIzL-U4MlV2sct0_X5Vjm0u-TuSexbngW5jNp9xCIzrxNsRJQOvgmfXmGdJkei_VNMSy4--8lJ29xXC3p9F6gzDQGci6SxWJj_jraiFIdtmjesUWXlvJ8CbXjgw';
        $noti->toSingleDevice($token, 'title', 'body', null, null);

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
