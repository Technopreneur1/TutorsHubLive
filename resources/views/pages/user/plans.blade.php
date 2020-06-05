@extends('layouts/master')
@section('title')
    {{auth()->user()->name}}
@endsection
@section('content')
  
    <div id="app">
        <div class="plans-page">
            <div class="container">
                <edit-plans :user="{{App\User::with('profile', 'profile.plans')->find(auth()->id())}}" url="{{route('home')}}" type="page"></edit-plans>
            </div>
        </div>
    </div>
    
@endsection
