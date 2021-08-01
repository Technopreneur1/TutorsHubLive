@extends('layouts.master')
@section('title')
    Messages
@endsection
@section('content')
    <div class="messagesPage">
        <div id="app" class="full-container" style="background: none">
            @if ($with)
                <chat-app :user="{{ auth()->user() }}" url="{{route('home')}}" :with="{{$with}}" :allowancesettings="{{ $allowanceSettings ? : json_encode(null) }}" :adminsettings="{{ $admin_settings }}"></chat-app>
            @else
                <chat-app :user="{{ auth()->user() }}" url="{{route('home')}}" :allowancesettings="{{ $allowanceSettings }}" :adminsettings="{{ $admin_settings }}"></chat-app>
            @endif
        </div>
    </div>

@endsection
