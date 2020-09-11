@extends('layouts.master')
@section('title')
Blog | Labs-Hub
@endsection
@section('content')
    <div class="post-page">
        <div class="post-header" style="background: linear-gradient( -45deg, #eb8832d6, #000000d9),  url({{asset('storage/blog') . "/" . $post->image}})">
            <h1 class="title">{{$post->title}}</h1>
            <div class="date">{{Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</div>
        </div>
        <div class="post-body">
            <div class="container">
               <p> {!! $post->description !!}</p> 
            </div>
        </div>
    </div>
@endsection