@extends('layouts.master')

@section('content')

    <link rel="stylesheet" href="/css/ionicons.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/sheet.css">
    <link rel="stylesheet" href="/css/create-post.css">



    @include('front-end.header')
    <div class="slider"></div>
    <main>

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-lg-4 "></div>

                <div class="col-md-4 ">

                    <div title=""><h5>Edit post</h5></div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title">



                    <label for="image">Image</label>
                    <input type="file" name="image" id="image">



                    <textarea rows="8" cols="auto" title="text" name="body" placeholder="Write your text here." id="body"></textarea>

                    <fieldset>
                        <input class="submit-btn" type="submit" name="submitpost" value="Submit post">
                    </fieldset>
                </div>
            </div>
        </form>
    </main>

    @include('front-end.footer')
    <script src="jquery-3.1.1.min.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
@endsection