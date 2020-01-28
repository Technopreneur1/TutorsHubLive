@extends('layouts.master')
@section('title')
    Home
@endsection
@section('content')
    <div id="app"  class="homepage">
        <register-form url="{{route('home')}}" ></register-form>
        
        <section class="hiw">
            <div class="fsec">
                <div class="container">
                    {{-- <div class="heading">How It Works</div> --}}
                    <div class="row">
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step"><span>Step 1</span></div> --}}
                                <div class="title">Register & Setup Profile</div>
                                <div class="text">You can register as a student or a tutor. Fill the registeration form and setup your profile.</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/form.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fsec">
                <div class="container">
                    
                    <div class="row rev">
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/map.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step">Step 2.1</div> --}}
                                <div class="title">Search Tutors</div>
                                <div class="text">As a student you can search for tutors around you in matter of few clicks.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fsec">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step">Step 2.2</div> --}}
                                <div class="title">Post an Ad</div>
                                <div class="text">Students can also post ad that will be visible to tutors within selected area.</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/post.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fsec">
                <div class="container">
                    <div class="row rev">
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/chat.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step">Step 3</div> --}}
                                <div class="title">Contact Tutor</div>
                                <div class="text">Tutors-Hub offer real-time chat service for free. Students and tutors can communicate with eachother on the website.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fsec">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step">Step 4</div> --}}
                                <div class="title">Book a Session Online</div>
                                <div class="text">Student can book sessions with tutors on the website by selecting a plan offered by tutor and number of hours. Student will pay the booking amount online.</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/booking.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fsec">
                <div class="container">
                    <div class="row rev">
                        <div class="col-md-5">
                            <div class="image">
                                <img class="responsive" src="{{asset('img/feed.svg')}}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="data">
                                {{-- <div class="step">Step 5</div> --}}
                                <div class="title">Rate & Leave Feedback</div>
                                <div class="text">After a session, student and tutor can rate and leave a review for eachother. All reviews and feedbacks will be visible on user's profile</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </div>
@endsection
