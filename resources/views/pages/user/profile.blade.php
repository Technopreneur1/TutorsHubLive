@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
    <style>
        .book-section, .edit-profile-slideout {
            display: -webkit-box;
            display: flex;
            -webkit-box-pack: center;
            justify-content: center;
        }
        .book-section .bookingform, .edit-profile-slideout .showThanks {
            width: 500px;
            max-width: 100%;
        }
        .book-section .bookingform .heading, .edit-profile-slideout .thnaku {
            margin-bottom: 20px;
            font-size: 25px;
            text-align: center;
            font-weight: bold;
        }
        .book-section .bookingform .info table {
            background: #fdfdfd;
            width: 100%;
        }
        .edit-profile-slideout .links {
            width: 160px;
            padding: 5px 15px;
            text-align: center;
        }
        .book-section .bookingform .info table tr td , .edit-profile-slideout .pleaced , .edit-profile-slideout .adv{
            padding: 5px 15px;
        }
        .book-section .bookingform .hours {
            margin: 20px 0 10px;
            text-align: center;
        }
        .book-section .bookingform .hours .input, .book-section .bookingform .dte .input, .book-section .bookingform .sessiontype .input {
            max-width: 300px;
            margin: 0 auto;
        }
        .book-section .bookingform .total {
            font-size: 40px;
            font-weight: bold;
            text-align: center;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
        }
        .book-section .bookingform .btn-book {
            border: none;
            width: 125px;
            background: #2575bc;
            color: #ffffff;
            border-radius: 4px;
            width: 300px;
            margin: 0px auto;
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
    <profile :tz="{{json_encode($timezones)}}" url="{{route('home')}}" :likes="{{$likes}}" :user="{{$user}}" :authuser="{{auth()->user()}}" rating="{{$user->profile->completedSessions->average($type)}}"></profile>
    </div>

@endsection
