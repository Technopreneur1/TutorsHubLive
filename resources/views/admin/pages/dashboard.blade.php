@extends('admin.layouts.master')
@section('title')
Adminpanel
@endsection()
@section('content')

    <div class="container">
        
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.tutors')}}">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-chalkboard-teacher"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Teachers</span>
                            <span class="info-box-number">{{App\User::where('type', 'teacher')->count()}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.students')}}">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-user-graduate"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Students</span>
                            <span class="info-box-number">{{App\User::where('type', 'student')->count()}}</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.ads')}}">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-ad"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Ads</span>
                            <span class="info-box-number">{{App\Ad::all()->count()}}</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.sessions')}}">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sessions</span>
                            <span class="info-box-number">{{App\Session::all()->count()}}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <h2>Recent</h2>
        <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.sessions')}}">
                        <span class="info-box-icon bg-red"><i class="fa fa-calendar-plus"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Sessions</span>
                            <span class="info-box-number">{{App\Session::where('seen', 0)->count()}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <a href="{{route('admin.tickets')}}">
                        <span class="info-box-icon bg-red"><i class="fa fa-ticket-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Open Tickets</span>
                            <span class="info-box-number">{{App\Ticket::where('resolved', 0)->count()}}</span>
                        </div>
                    </a>
                    <!-- /.info-box-content -->
                </div>
            </div>
            
        </div>
    </div>

@endsection

