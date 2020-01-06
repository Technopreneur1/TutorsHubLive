@extends('admin.layouts.master')
@section('title')
{{$user->name}}  | Admin Panel
@endsection()
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Details</h3>
                </div>
                <div class="box-body">
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <h3 class="widget-user-username">{{$user->name}}</h3>
                             <p>{{$user->type == 'teacher' ? 'Tutor' : 'Student'}}</p>
                        </div>
                        <div class="widget-user-image">
                            @if ($user->avatar)
                                <img class="img-circle elevation-2" src="{{asset('storage/images/')}}/{{$user->avatar}}" alt="User Avatar">
                            @else
                                <img class="img-circle elevation-2" src="{{asset('img/')}}/male.jpg" alt="User Avatar">
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                <h5 class="description-header">{{$user->profile->sessions->count()}}</h5>
                                <span class="description-text">Sessions</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                <h5 class="description-header">{{$user->profile->plans->count()}}</h5>
                                <span class="description-text">Plans</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                <h5 class="description-header"> ${{App\Earning::balance($user->profile)}}</h5>
                                <span class="description-text">Balance</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Profile Information
                    </div>

                    <div class="box-body">
                        <table class="table table-hover" style="background: #fff">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{$user->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{$user->gender}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$user->country->name}}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{$user->city->name}}</td>
                                </tr>
                                <tr>
                                    <td>Neighborhood</td>
                                    <td>{{$user->neighborhood->name}}</td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
       
    </div>
@endsection
