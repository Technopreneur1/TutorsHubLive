@extends('layouts/master')
@section('title')
    Ads
@endsection
@section('content')
    <div id="app" class="ads-page">
        <div class="full-container">
            <create-ad url="{{route('home')}}" authid="{{auth()->id()}}" :authuser="{{auth()->user()}}">></create-ad>
        </div>
    </div>
@endsection
