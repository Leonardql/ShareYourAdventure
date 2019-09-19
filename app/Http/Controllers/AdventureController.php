<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adventure;

class AdventureController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Adventure::orderBy('id', 'desc')->get();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);
        return Adventure::create(['body' => request('body')]);
    }
    public function edit(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);
        $task = Adventure::findOrFail($request->id);
        $task->body = $request->body;
        $task->save();
    }

//    public function destroy($id)
//    {
//        $task = Adventure::findOrFail($id);
//        $task->delete();
//    }
}
