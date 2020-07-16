@extends('layouts/master')
@section('title')
    Sessions | {{auth()->user()->name}}
@endsection
@section('content')

    <div class="sessionsPage" id="app">
        <sessions url="{{route('home')}}" :sessions="{{$sessions}}" :authuser="{{auth()->user()}}"></sessions>
    </div>


@endsection
