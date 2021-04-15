@extends('layouts/master')
@section('title')
    Saved Ads
@endsection

@section('content')
    <div id="app" class="favoritesPage">
        <div class="title">Saved Ads</div>
        <saved-ads url="{{route('home')}}" :authuser="{{$user}}"></saved-ads>
    </div>
@endsection
