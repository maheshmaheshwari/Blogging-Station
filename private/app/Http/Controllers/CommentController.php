<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $hidden = decrypt($request->post('data'));

        $comment = new Comment;

        $comment->user_id = auth()->user()->id;
        $comment->article_id = $hidden['article_id'];
        $comment->status = 1;
        $comment->parent_id = $hidden['parent_id'];
        $comment->content = $request->post('content');

        $comment->save();

        return back();
    }

    public function replyStore(Request $request)
    {
        $hidden = decrypt($request->post('data'));

        $reply = new Comment;

        $reply->user_id = auth()->user()->id;
        $reply->article_id = $hidden['article_id'];
        $reply->status = 1;
        $reply->parent_id = $hidden['parent_id'];
        $reply->content = $request->post('content');

        $reply->save();

        return back();
    }
}
