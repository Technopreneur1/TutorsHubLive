@extends('layouts.master')
@section('title')
    Login
@endsection
@section('styles')
    <style>
        .log-box{
            padding: 10px 15px;
            border-radius: 3px;
            background: #fff;
            width: 550px;
            margin: 0 auto;
            max-width: 100%;
            text-align: center

        }
        .btn-log{
            background: #53a221;
            color: #fff;
            font-size: 15px;
            width: 140px;
            max-width: 100%;
            padding: 4px 10px;
        }
        .form-group{
            text-align: left
        }
        label{
            margin-bottom: 0;
        }
        </style>
@endsection
@section('content')
    <div class="home-page">
        <div class="hero">
            {{-- Form box inside hero --}}
            <div id="app" class="full-container" style="background: none">
                <div class="log-box">
                    @if (session('message'))
                        <div class="alert alert-danger">{{ session('message') }}</div>
                    @endif
                    <div style="font-size: 33px; text-align: center; margin-bottom: 25px">Login</div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group text-center">
                                <button type="submit" class="btn btn-log">
                                    {{ __('Login') }}
                                </button>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <a class="btn btn-link" href="https://tutors-hub.com/student-registration">
                            {{ __('Sign Up Student') }}
                        </a>
                        <a class="btn btn-link" href="https://tutors-hub.com/teacher-registration">
                            Sign Up Tutor
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
