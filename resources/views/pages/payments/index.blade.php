@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
    @if (\Session::has('message'))
        <div class="alert alert-success" style="margin-top: 60px;">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif

    @if (\Session::has('error'))
        <div class="alert alert-danger" style="margin-top: 60px;">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif

    <div class="payments-page" id="app">
        <payments-page
            url="{{route('home')}}"
            :net="{{$net}}"
            :withdrawn="{{$withdrawn}}"
            :balance="{{$balance}}"
            :payments="{{$payments}}"
            :gross="{{$gross}}"
            :authuser="{{auth()->user()}}"
            ></payments-page>
    </div>

@endsection
