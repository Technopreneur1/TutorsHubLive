@extends('layouts/master')
@section('title')
    My Ads
@endsection
@section('content')
    <div id="app" class="myads-page">
            <my-ads url="{{route('home')}}" authid="{{auth()->id()}}"></my-ads>
    </div>
@endsection
