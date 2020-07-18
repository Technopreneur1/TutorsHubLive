@extends('layouts/master')
@section('title')
    Home
@endsection
@section('content')
    <div class="user-home">
        <div class="full-container">
{{--            @if (auth()->user()->latitude  == null || auth()->user()->latitude == null)--}}
                <div class="alert alert-primary" role="alert">
                    Your profile is hidden. Please set your location now to show in search results. <a href="{{route('settings')}}">Click Here</a>
                </div>
{{--            @endif--}}
            <div style="margin: 0 -15px">
                <div class="text">
                    <div class="title">Dash<span>board</span></div>
                </div>
                <div class="usergrid">
                    <div class="item">
                        <a href="{{route('home')}}">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{route('messages')}}">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                            @if ($messages)
                            <span class="count">{{$messages}}</span>
                            @endif
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{route('profile')}}">
                            <i class="fas fa-user"></i>
                            <span>My Account</span>
                        </a>
                    </div>
                    @if (auth()->user()->type == 'student')
                        <div class="item">
                            <a href="{{route('findTutors')}}">
                                <i class="fas fa-search"></i>
                                <span>Find Tutor</span>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->type == 'teacher')
                        <div class="item">
                            <a href="{{route('ads')}}">
                                <i class="fas fa-search"></i>
                                <span>Find Students</span>
                            </a>
                        </div>
                    @endif
                    @if (auth()->user()->type == 'student')
                        <div class="item">
                            <a href="{{route('createAd')}}">
                                <i class="fas fa-plus"></i>
                                <span>Post an Ad</span>
                            </a>
                        </div>
                        <div class="item">
                            <a href="{{route('myAds')}}">
                                <i class="fas fa-plus"></i>
                                <span>My Ads</span>
                            </a>
                        </div>
                    @endif
                    <div class="item">
                        <a href="{{route('favorites')}}">
                            <i class="fas fa-star"></i>
                            <span>Saved Profiles</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="{{route('sessions')}}">
                            <i class="fas fa-calendar-alt"></i>
                            <span>My Sessions</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
