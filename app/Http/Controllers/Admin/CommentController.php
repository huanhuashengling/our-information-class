<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use App\Models\Work;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        foreach ($comments as $key => $comment) {
            $work = Work::find($comment->work_id);
            $comment->work_title = $work->title;
        }
        return view('admin/comment/index')->withComments($comments);
    }

    public function edit($id)
    {
        return view('admin/comment/edit')->withComment(Comment::with('hasOneWork')->find($id));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->content = $request->get('content');

        if ($comment->save()) {
            return redirect('admin/comment');
        } else {
            return redirect()->back()->withInput()->withErrors("编辑失败！");
        }
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
