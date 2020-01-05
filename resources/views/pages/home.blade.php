@extends('layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <div class="home-page">
        <div class="hero">
            {{-- Form box inside hero --}}
            <div id="app" class="full-container" style="background: none">
                <div class="flexible">
                   
                    <register-form url="{{route('home')}}" ></register-form>
                    
                    <!-- home-form -->
                </div>
            </div>
        </div>
    </div>
@endsection
