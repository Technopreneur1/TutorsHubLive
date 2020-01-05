@extends('layouts/master')
@section('title')
    Find Tutor
@endsection
@section('content')
    <div id="app">
        <tutor-search url="{{route('home')}}"></tutor-search>
    </div>
@endsection
