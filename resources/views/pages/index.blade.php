@extends('layouts.master')

@section('content')


    <link rel="stylesheet" href="/css/sheet.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/chat.css">
    <link rel="stylesheet" href="/css/canvas.css">




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
                                    @if(Auth::check())
                                    <ul class="post-footer">

                                        <li><a href="/liked/{{$post->id}}"><i class="ion-md-heart"></i>{{count($post->likes)}}</a></li>
                                        <li><a href="/posts/{{$post->id}}"><i class="ion-md-chatboxes"></i>{{count($post->comments)}}</a></li>
                                        <li><a href="#"><i class="ion-md-eye"></i>{{$post->view_counter}}</a></li>
                                    </ul>
                                        @else
                                        <ul class="post-footer">

                                            <li><a href="#"><i class="ion-md-heart"></i>{{count($post->likes)}}</a></li>
                                            <li><a href="#"><i class="ion-md-chatboxes"></i>{{count($post->comments)}}</a></li>
                                            <li><a href="#"><i class="ion-md-eye"></i>{{$post->view_counter}}</a></li>
                                        </ul>

                                        @endif



                                </div>
                            </article>
                        </div>
                    </div>

                @endforeach
            @else
                <p> No posts have been made yet</p>
            @endif



        </div>
        {{ $posts->links() }}
        </div>
    <form>
        <div class="chat">
            <p>Public chat</p>
            <ul id="chat-list"></ul>
            <hr>
            <input type="text" id="message" placeholder="message..." required>
            <input type="submit" id="submit" value="Send message"/>
        </div>
    </form>
</main>
@include('front-end.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="/js/canvas.js"></script>
    <script>

        document.addEventListener("DOMContentLoaded", init);

        let conn = new WebSocket('ws://shareyouradventure.local:1234/');

        let chatInformation = {
            username: new Date().getTime().toString()

        };



        conn.onopen = function(e) {
            console.log("Connection established succesfully");
        };

        conn.onmessage = function(e) {
            let data = JSON.parse(e.data);
            Chat.appendMessage(data.username, data.message);

        };

        conn.onerror = function(e){
            alert("Error: We can not make a connection.");
            console.error(e);
        };

        document.getElementById("submit").addEventListener("click",function(e){
            e.preventDefault();
            let msg = document.getElementById("message").value;

            if(!msg){
                alert("Chatbox is empty make sure you type something in.");
            }

            Chat.sendMessage(msg);

        }, false);

        let Chat = {
            appendMessage: function(username,message){
                let from;

                if(username === chatInformation.username){
                    from = "me";
                }else{
                    from = chatInformation.username;
                }

                let ul = document.getElementById("chat-list");
                let li = document.createElement("li");
                li.appendChild(document.createTextNode(from + " : "+ message));
                li.setAttribute("id", chatInformation.username);
                ul.appendChild(li);
            },
            sendMessage: function(text){
                chatInformation.message = text;
                conn.send(JSON.stringify(chatInformation));
                this.appendMessage(chatInformation.username, chatInformation.message);
            }
        };
    </script>

@endsection


