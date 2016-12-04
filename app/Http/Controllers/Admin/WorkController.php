<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Work;

class WorkController extends Controller
{
    public function index()
    {
        return view('admin/work/index')->withWorks(Work::all());
    }

    public function create()
    {
        return view('admin/work/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:works|max:255',
            'body' => 'required',
        ]);

        $work = new Work;
        $work->title = $request->get('title');
        $work->body = $request->get('body');
        $work->user_id = $request->user()->id;

        if ($work->save()) {
            return redirect('admin/work');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    public function edit($id)
    {
        return view('admin/work/edit')->withWork(Work::find($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:works,title,'.$id.'|max:255',
            'body' => 'required',
        ]);
        $work = Work::find($id);
        $work->title = $request->get('title');
        $work->body = $request->get('body');

        if ($work->save()) {
            return redirect('admin/work');
        } else {
            return redirect()->back()->withInput()->withErrors('编辑失败！');
        }
    }

    public function destroy($id)
    {
        Work::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
