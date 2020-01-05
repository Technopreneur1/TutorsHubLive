<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link href="{{asset('css/fontawesome-all.min.css')}}"  rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    
    @yield('styles')
</head>
<body>
    
    @include('partials/_nav')
    
    @yield('content')

    @include('partials/_footer')
    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>