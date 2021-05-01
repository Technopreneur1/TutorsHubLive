@extends('layouts.master')
@section('title')
    Contact & Support
@endsection

@section('content')
    <div class="contact-page">
        <div class="container">
            <h1 class="title" >Support <span>Center</span></h1>
            @if (auth()->check())
            <p>Hello! {{auth()->user()->name}}, Please write your query, message or issues in the following form. We will contact you shorly.</p>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                    <div class="cform">
                        <form action="{{route('contact.post')}}" method="post">
                            @csrf
                            @if (!auth()->check())
                                <div class="input">
                                    <label for="name">Your are: </label>
                                    <select name="type" id="">
                                        <option value="New User" >New User</option>
                                        <option value="Existing User" >Existing User</option>
                                    </select>
                                </div>
                                <div class="input">
                                    <label for="email">Your Email:</label>
                                    <input type="email" name="email" placeholder="john@mail.com">
                                </div>
                            @endif
                            <div class="input">
                                <label for="query">Your Query</label>
                                <textarea name="qry" id="" cols="30" rows="6" placeholder="Explain your query"></textarea>
                            </div>
                            @csrf
                            <div class="input text-right">
                                <button type="submit" class="btn btn-gradient">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
