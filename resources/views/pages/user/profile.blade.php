@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
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
