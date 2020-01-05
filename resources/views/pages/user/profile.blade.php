@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')

    <div id="app">
        <profile url="{{route('home')}}" :likes="{{$likes}}" :user="{{$user}}" :authuser="{{auth()->user()}}"></profile>
    </div>
    
@endsection
