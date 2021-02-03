@extends('layouts.master')
@section('title')
    {{$content->title}}
@endsection
@section('styles')
    <style>
        .privacy-page{
            padding: 50px 0;
            margin-top: 55px;
        }
        h1{
            font-size: 35px;
            text-align: center;
            margin-bottom: 30px;
        }
        p{
            font-size: 16px;
        }
    </style>
@endsection

@section('content')
    <div class="privacy-page">
        <div class="container">
            <h1>{{ $content->title }}</h1>
            <div class="scontent">{!! $content->description !!}</div>
        </div>
    </div>
@endsection
