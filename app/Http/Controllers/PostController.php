<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function show($id)
    {
        return view('post/show')->withPost(PostController::with('hasManyComments')->find($id));
    }
}
