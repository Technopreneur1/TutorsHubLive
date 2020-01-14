@extends('layouts.master')
@section('title')
    Support Center
@endsection
@section('styles')
    <style>
        .success-page{
            margin-top: 55px;
            min-height: calc(100vh - 55px);
            padding: 50px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            text-align: center;

        }
        .msg{
            font-size: 35px
        }
    </style>
@endsection

@section('content')
    <div class="success-page">
        <div class="msg">Thanks For Contacting Us</div>
        <div class="msg">We will contact you shortly</div>
        <h4 class="text-center">Ticket ID: {{$ticket}}</h4>
    </div>
@endsection
