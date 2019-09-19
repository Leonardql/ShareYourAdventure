@extends('layouts.master')

@section('content')

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

    <link rel="stylesheet" href="/css/ionicons.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/sheet.css">
    <link rel="stylesheet" href="/css/post.css">





@include('front-end.header')

<div class="slider"></div>

<main class="post-area section">
    <div class="container ">
        <div class="row">
            <div class="col-lg-1 col-md-0"></div>
            <div class="col-lg-10 col-md-12">

                <div class="main-post">

                    <div class="blog-post-inner">
                        <div class="post-info">
                            <div class="left-area">
                                <a class="avatar" href="#"><img src="/storage/avatars/{{$post->user->avatar}}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{$post->user->name}}</b></a>
                            </div>

                        </div>

                        <h3 class="title"><a href="#"><b>{{$post->title}}</b></a></h3>


                        <p class="text">{{$post->body}}</p>

                            <div class="post-image">
                                <img src="/storage/post_images/{{$post->image}}" alt="Blog Image">
                        </div>
                        @if(!Auth::guest())
                            @if(Auth::user()->id == $post->user_id)
                        <div class="changes"><a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id)}}" method="post">
                            @csrf
                            @METHOD("DELETE")
                            <input class="btn btn-primary" type="submit" value="Delete">
                            @endif

                        </form></div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<aside class="comment-section">
    <div class="container">

        <div class="row">
            <div class="col-lg-1 col-md-0"></div>
            <div class="col-lg-10 col-md-12">
                @if(!Auth::guest())
                <h3>POST COMMENT</h3>

                <div class="comment-form" >
                    <form action="/posts/{{$post->id}}/comments" method="post">
                        @csrf
                        <div class="row">

                            <fieldset class="col-sm-12">
									<textarea name="body" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment">

                                    </textarea >
                            </fieldset>

                            <fieldset class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </fieldset>

                        </div>
                    </form>
                </div>
                @endif


                <h3>COMMENTS ({{count($post->comments)}})</h3>


                @if(count($post->comments)> 0)
                    @foreach($post->comments as $comment)
                        <div class="commnets-area">
                            <div class="comment">
                                <div class="post-info">

                                    <div class="left-area">
                                        <a class="avatar" href="#"><img src="/storage/avatars/{{$comment->user->avatar}}" alt="Profile Image"></a>
                                    </div>

                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{$comment->user->name}}</b></a>

                                    </div>
                                </div>
                                <p>{{$comment->body}}</p>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</aside>

@include('front-end.footer')

@endsection