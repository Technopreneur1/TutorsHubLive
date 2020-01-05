@extends('layouts/master')
@section('title')
    Student's Ads
@endsection
@section('content')
    <div id="app" class="ads-page">
        <ads url="{{route('home')}}" ></ads>
    </div>
@endsection
