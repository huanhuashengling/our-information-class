<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return view('teacher/comment/index')->withLessons(Comment::all());
    }

    public function getByPostsId(Request $request)
    {
        $comment = Comment::where(['posts_id' => $request->get('posts_id')])->first();
        if (isset($comment)) {
            return json_encode($comment);
        } else {
            return "false";
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'posts_id' => 'required',
            'content' => 'required|max:255',
        ]);

        $comment = new Comment;
        $comment->users_id = \Auth::user()->id;
        $comment->posts_id = $request->get('posts_id');
        $comment->content = $request->get('content');;

        if ($comment->save()) {
            return "true";
        } else {
            return "false";
        }
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'posts_id' => 'required',
            'content' => 'required|max:255',
        ]);

        $comment = Comment::find($request->get('comments_id'));
        $comment->users_id = \Auth::user()->id;
        $comment->posts_id = $request->get('posts_id');
        $comment->content = $request->get('content');

        if ($comment->update()) {
            return "true";
        } else {
            return "false";
        }
    }
}
