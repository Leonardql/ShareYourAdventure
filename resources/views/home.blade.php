@extends('layouts.master')

@section('content')

    <link rel="stylesheet" href="/css/sheet.css">
    <link rel="stylesheet" href="/css/home.css">

    @include('front-end.header')
<div class="slider"></div>

<main class="blog-area section">
    <div class="container">

        <div class="row">

            @if(count($posts)> 0)
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <article class="single-post">

                                <div class="blog-image">
                                    <img src="/storage/post_images/{{$post->image}}" alt="Blog Image">
                                </div>

                                <a class="avatar" href="#">
                                    <img src="/storage/avatars/{{$post->user->avatar}}" alt="Profile Image">
                                </a>

                                <div class="blog-info">
                                    <h2>
                                        <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                    </h2>


                                        <ul class="post-footer">

                                            <li><a href="/liked/{{$post->id}}"><i class="ion-md-heart"></i>{{count($post->likes)}}</a></li>
                                            <li><a href="/posts/{{$post->id}}"><i class="ion-md-chatboxes"></i>{{count($post->comments)}}</a></li>
                                            <li><a href="#"><i class="ion-md-eye"></i>{{$post->view_counter}}</a></li>
                                        </ul>


                                </div>
                            </article>
                        </div>
                    </div>

                @endforeach
            @else
                <p> You have not made a post yet.  </p>
            @endif


        </div>

    </div>
</main>
@include('front-end.footer')
@endsection