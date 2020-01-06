@extends('admin.layouts.master')
@section('title')
Adminpanel
@endsection()
@section('content')

    <div class="container">
        Adminpanel
        {{-- <div class="row">
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Registered Users</span>
                        <span class="info-box-number">{{App\User::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Admins</span>
                        <span class="info-box-number">{{App\User::where('is_admin', 1)->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Threads</span>
                        <span class="info-box-number">{{App\Thread::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Answers</span>
                        <span class="info-box-number">{{App\Answer::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Inisghts</span>
                        <span class="info-box-number">{{App\Insight::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Series</span>
                        <span class="info-box-number">{{App\Series::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Products</span>
                        <span class="info-box-number">{{App\Product::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Orders</span>
                        <span class="info-box-number">{{App\Order::all()->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div> --}}
    </div>

@endsection

