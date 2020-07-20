@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
    <style>
        .book-section {
            display: block;
            text-align: center;
            max-width: 500px;
            margin: auto;
        }
        .book-section table {
            margin: auto;
        }
        .book-section .heading {
            font-size: 28px;
        }
        .book-section .total {
            font-size: 22px;
        }
        .book-section tr {
            font-size: 18px;
        }
        .book-section .btns{
            width: 130px;
        }
        </style>
    @php
        if($user->type == 'teacher')
        {
            $type = 'tutor_rating';
        }else{
            $type = 'student_rating';
        }
    @endphp
    <div id="app">
    <profile url="{{route('home')}}" :likes="{{$likes}}" :user="{{$user}}" :authuser="{{auth()->user()}}" rating="{{$user->profile->completedSessions->average($type)}}"></profile>
    </div>

@endsection
