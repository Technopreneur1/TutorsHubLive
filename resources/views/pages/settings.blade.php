@extends('layouts/master')

@section('title')
    Settings
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />
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
