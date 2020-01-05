@extends('layouts.master')
@section('title')
    Messages
@endsection
@section('content')
    <div class="messagesPage">
        <div id="app" class="full-container" style="background: none">
            @if ($with)
                <chat-app :user="{{ auth()->user() }}" url="{{route('home')}}" :with="{{$with}}"></chat-app>
            @else
                <chat-app :user="{{ auth()->user() }}" url="{{route('home')}}" ></chat-app>
            @endif
        </div>
    </div>
                    
@endsection