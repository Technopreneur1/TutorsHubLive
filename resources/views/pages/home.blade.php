@extends('layouts.master')
@section('title')
    Home
@endsection
@section('meta')
    <style>
      .pre-loader{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #fbfbfb;
        z-index: 111;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .hidden{
          display: none;
      }
      .lds-ring {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
        }
        .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid rgb(39, 179, 51);
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: rgb(181, 255, 134) transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
        }
        @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
        }
    </style>
    <script>
        window.addEventListener("load", function()
        {
            const loader = document.querySelector(".pre-loader");
            loader.className += " hidden";
        })
    </script>
@endsection
@section('content')
    <div class="pre-loader">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>

    </div>
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
                                <div class="text">You can register as a student or as a tutor. Fill out the registration form and setup your profile.</div>
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
                                <div class="text">As a student you can search for tutors around you in matter of few clicks. You can see their profiles that show the subjects they teach, their rates along with feedback and ratings from other students.</div>
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
                                <div class="text">Students can also post an ad that will be visible to tutors within a selected area. Find the right tutor that fits your criteria.</div>
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
                                <div class="text">Tutors-Hub offers real-time chat service for free. Students and tutors can communicate with one another on the platform. Also you can always message an admin for any help or support.
                                </div>
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
                                <div class="text">Students can book sessions with tutors on the website by selecting a plan offered by a tutor along with the number of hours for the session. </div>
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
                                <div class="text">After a session, students and tutor scan rate and leave a review for others to see.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </div>
@endsection
