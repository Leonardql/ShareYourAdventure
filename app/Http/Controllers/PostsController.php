<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Input;
use function PhpParser\filesInDir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use File;
use App\User;


class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts = Post::all();

        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('pages.index') -> with('posts', $posts) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
        ],
        [
            'image.required' => 'Please, choose an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png.',
            'image.max' => 'The image may not be greater than 2048kb.'
        ]);


        if ($request->hasFile('image')){

            // get file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //get just ext
            $extension = $request->file('image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('image')->storeAs('public/post_images', $fileNameToStore);

        }else{
            $fileNameToStore = 'default.png';

        }


        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post added successfully ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);
        $post->increment("view_counter");
        return view('pages.post') -> with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts') -> with('error', 'Unauthorized page');
        }
        return view('posts.edit') -> with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        if ($request->hasFile('image')){

            // get file name with extension
            $fileNameWithExt = $request->file('image')->getClientOriginalName();

            // get just file name
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //get just ext
            $extension = $request->file('image')->getClientOriginalExtension();

            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('image')->storeAs('public/post_images', $fileNameToStore);

        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('image')){
            $post->image = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts') -> with('error', 'Unauthorized page');
        }

        if ($post->image != 'default.png'){
            Storage::delete('public/post_images/'.$post->image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');
    }


    public function indexWithLogin()
    {
//        $posts = Post::all();
//        $posts = Post::where('user_id', Auth::user()->id)->get();
//        return view('home') -> with('posts', $posts) ;

        $userId = auth()->user()->id;
        $user = User::find($userId);
        return view('home')->with('posts', $user->posts);
    }
}
