<style>
    
    /* Header/Logo Title */
    .header {
      padding: 150px;
      text-align: center;
      /* background: #1abc9c; */
      color: white;
      font-size: 30px;
    }
    
    /* Page Content */
    /* .content {padding:20px;} */
    </style>
@extends('layouts.master')
@section('title')
Blog | Labs-Hub
@endsection
@section('content')
    <div class="header" style="background: linear-gradient( -45deg, #eb8832d6, #000000d9),  url({{asset('storage/blog') . "/" . $post->image}})">
        <h1>{{$post->title}}</h1>
        <p>{{Carbon\Carbon::parse($post->created_at)->format('d M, Y')}}</p>
    </div>
    <div class="post-body">
        <div class="container">
            <p> {!! $post->description !!}</p> 
        </div>
    </div>
@endsection