@extends('layouts/master')
@section('title')
    Sessions | {{auth()->user()->name}}
@endsection
@section('content')
<style>
    .sessionsList .session{
        display: -webkit-box;
        display: flex;
        background: #e4f3e4;
        padding: 5px;
        border-radius: 3px;
        -webkit-box-pack: justify;
        justify-content: space-between;
        margin-bottom: 10px;
        flex-wrap: wrap;
        box-shadow: 0 1px 1px 0 #53a2216b;
    }
    .sessionsList .session .with {
        margin: 10px 0;
    }
    .sessionsList .session .with .avatar {
        width: 65px;
        height: 65px;
        margin: 0 auto;
    }
    .sessionsList .session .with .avatar img {
        max-width: 100%;
        border-radius: 50%;
    }
    .sessionsList .session .info {
        padding: 0 5px;
        margin: 5px 0;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
    }
    .sessionsList .session .info {
        padding: 0 5px;
        margin: 5px 0;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
    }
    .sessionsList .session .actions {
        margin: 10px 0;
        padding: 0 5px;
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        -webkit-box-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        align-items: center;
    }
    .rates{
        background: linear-gradient(45deg, #2575bc, #0b61ff);
        color: #fff;
        margin: 0 -15px;
        padding: 5px 0;
        display: -webkit-box;
        display: flex;
        justify-content: space-around;
        box-shadow: 0 1px 1px 0 #53a2216b;
    }
    .rates .hours {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        text-align: center;
    }
    .rates .hours .key {
        letter-spacing: 4px;
    }
    .rates .hours .value {
        font-size: 20px;
        font-weight: bold;
    }
    .view-session .statusbar[data-v-2d3eefba] {
        margin: 0 -15px 10px;
        padding: 5px 10px;
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        background: linear-gradient(45deg, #54a323, #6edb95);
        color: #fff;
        border-radius: 3px;
        flex-wrap: wrap;
        -webkit-box-pack: center;
        justify-content: center;
        text-align: center;
    }
    .view-session .statusbar .val {
        font-size: 20px;
        color: #ffffff;
        font-weight: bold;
        margin-right: 20px;
    }
    .view-session .statusbar .txt {
        font-size: 15px;
        font-weight: bold;
        margin-right: 15px;
    }
    .view-session .paypal-buttons, .view-session .btn {
        width: 200px !important;
        margin: auto;
        text-align: center;
        margin-bottom: 25px;
        margin-top: 25px;
        display: block !important;
    }
    .nav-tabs{
        background-color: #2575BC!important;
        border-radius: 6px;

        box-shadow: 0 1px 1px 0 #31a4e3;

    }
    .nav-link, .nav-link:hover{
        color: white;

    }
    .nav-link.active
  {
        background-color: green!important;
        color: white !important;
    }
    .session-tabs{
        margin-bottom: 20px!important;


    }
</style>

    <div class="sessionsPage" id="app">
        <sessions
            url="{{route('home')}}"
            sessionstext="{{$sessionText}}"
            :sessions="{{$sessions}}"
            :authuser="{{auth()->user()}}">

        </sessions>

{{--        @if($sessionText)--}}
{{--            <div class="container">--}}
{{--                <div class="d-flex alert alert-info justify-content-st">--}}
{{--                    ** {{ $sessionText }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>


@endsection
