<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Auth;
use App\Post;

class LikeController extends Controller
{
    public function store( Post $post)
    {

        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::id();
        $like->save();

        return redirect('/' )->with('success', 'Post liked successfully ');


    }
}
