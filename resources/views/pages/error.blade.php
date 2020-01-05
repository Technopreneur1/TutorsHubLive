@extends('layouts.master')
@section('title')
    Home
@endsection
@section('styles')
    <style>
        .error-page{
            margin-top: 55px;
            min-height: calc(100vh - 55px);
            padding: 50px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;

        }
        .msg{
            font-size: 35px
        }
    </style>
@endsection

@section('content')
    <div class="error-page">
        <div class="msg">{{$message}}</div>
    </div>
@endsection
