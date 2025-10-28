<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    function index(){
        return view('post.add-post');
    }

    function store(Request $request){
        // Validate the request data
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        return redirect()->route('add-post')->with('success', 'Post added successfully!');
    }
}
