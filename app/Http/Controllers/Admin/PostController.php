<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('admin/post/index')->withPosts(Post::all());
    }

    public function create()
    {
        return view('admin/post/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->users_id = $request->user()->id;

        if ($post->save()) {
            return redirect('admin/post');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function edit($id)
    {
        return view('admin/post/edit')->withPost(Post::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$id.'|max:255',
            'body' => 'required',
        ]);
        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->body = $request->get('body');

        if ($post->save()) {
            return redirect('admin/post');
        } else {
            return redirect()->back()->withInput()->withErrors('编辑失败！');
        }
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
