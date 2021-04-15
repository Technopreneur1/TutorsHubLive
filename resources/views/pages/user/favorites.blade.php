@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')

    <div class="favoritesPage" id="app">
        <div class="title">Saved Profiles</div>
        <favorites url="{{route('home')}}" :favorites="{{$favorites}}"></favorites>
    </div>

@endsection
