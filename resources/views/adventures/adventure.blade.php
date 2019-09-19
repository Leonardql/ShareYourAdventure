@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="/css/sheet.css">
<link rel="stylesheet" href="/css/home.css">
<link rel="stylesheet" href="/css/task.css">



<body>

@include('front-end.header')
<div class="slider"></div>

@if(Auth::check()){
<div id='app' class="container">
    <adventures-list>
    </adventures-list>
</div>
}@else
<h2> You have to log in to see the content.</h2>
    <h2><a href="/login">click here to login</a></h2>

@endif

@include('front-end.footer')
<script src="js/app.js"></script>
</body>
</html>
@endsection