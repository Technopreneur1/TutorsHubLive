@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')

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
