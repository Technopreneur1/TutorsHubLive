@extends('layouts/master')
@section('title')
    Find Tutor
@endsection
@section('content')
    <div id="app">
        <tutor-search url="{{route('home')}}" :authuser="{{$user}}"></tutor-search>
    </div>
@endsection
