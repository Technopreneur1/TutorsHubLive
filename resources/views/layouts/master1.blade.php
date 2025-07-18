<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <title>@yield('title')</title>
    @yield('meta')

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link href="{{asset('css/fontawesome-all.min.css')}}"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">



    @yield('styles')
</head>
<body>

   @include('partials/nav')
    <div class="text">
        <div class="title">@yield('page')</div>
    </div>
    @yield('content')

   @include('partials/footer')



    @yield('scripts')
</body>
</html>
