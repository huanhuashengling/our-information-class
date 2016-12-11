<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Work;

class WorkController extends Controller
{
    public function show($id)
    {
        return view('work/show')->withWork(Work::with('hasManyComments')->find($id));
    }
}
