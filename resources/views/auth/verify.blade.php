@extends('layouts.master')
@section('title')
    Confirm Email
@endsection
@section('styles')
    <style>
        .full-container
        {
            background: rgb(228, 243, 228);
            border-radius: 5px;
            color: #000;
        }
        .card-body{
            font-size: 17px;
            text-align: center
        }
    </style>
@endsection
@section('content')
<div class="home-page">
    <div class="hero">
        {{-- Form box inside hero --}}
        <div id="app" class="full-container">
            <div style="font-size: 33px; text-align: center;">Confirm Your Email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form  method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
