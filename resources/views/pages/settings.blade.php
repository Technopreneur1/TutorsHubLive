@extends('layouts/master')
@section('title')
    Settings
@endsection
@section('page')
    Settings
@endsection
@section('content')
    <div id="app" class="myads-page">
        <div class="full-container" >
            <div class="dash-box">
                <map-input ulat="{{auth()->user()->latitude}}" ulng="{{auth()->user()->longitude}}" ></map-input>

            </div>
        </div>
    </div>
@endsection
