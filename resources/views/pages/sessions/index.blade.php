@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')

    <div class="sessionsPage" id="app">
        <div class="title">My Sessions</div>
        <sessions url="{{route('home')}}" :sessions="{{$sessions}}" :authuser="{{auth()->user()}}"></sessions>
    </div>
    
@endsection
