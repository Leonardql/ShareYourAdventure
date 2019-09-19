<!DOCTYPE HTML>
<html lang="en">
<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://unpkg.com/ionicons@4.4.7/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/ionicons.css">
    <title>{{config('app.name', 'Share your adventure')}}</title>




</head>
<body>

        @include('inc.messages')
        @yield('content')

</body>
</html>