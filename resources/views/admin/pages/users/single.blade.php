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
                            <div class="col-sm-3 border-right">
                                @if ($user->type ==  'teacher')
                                    <div class="description-block">
                                        <h5 class="description-header">{{$user->profile->plans->count()}}</h5>
                                        <span class="description-text">Plans</span>
                                    </div>
                                @endif
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-3 border-right">
                                @if ($user->type ==  'teacher')
                                    <div class="description-block">
                                        <h5 class="description-header"> ${{App\Earning::balance($user->profile)}}</h5>
                                        <span class="description-text">Balance</span>
                                    </div>
                                @endif
                                <!-- /.description-block -->
                            </div>
                            <div class="col-sm-2 border-right">
                                <div class="description-block">
                                    <a href="{{route("admin.contact",[ $user->id, "TS0000"])}}" class="btn btn-success">Message User</a>
                                </div>
                            </div>
                            <div class="col-sm-2 border-right">
                                <div class="description-block">
                                    <form action="{{route('admin.loginas')}}" method="POST" style="display: inline; tex">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$user->id}}">
                                        <button onclick="confirm('Are you sure you want to login to user\'s account)" class="btn btn-info">Login as {{$user->name}}</button>
                                    </form>
                                </div>
                            </div>
                            @if (!$user->email_verified_at)
                                <div class="col-sm-2 border-right">
                                    <div class="description-block">
                                        <form action="{{route('admin.verifyemail')}}" method="POST" style="display: inline; tex">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$user->id}}">
                                            <button onclick="confirm('Are you sure you want to manually verify user\'s email)" class="btn btn-success">Verify Email</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
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
                                    <td>Status</td>
                                    <td>
                                        @if ($user->is_banned)
                                            <span>Banned</span>
                                            <form action="{{route('admin.ban', $user->id)}}" style="display: inline; margin-left: 20px" method="post">
                                               <button class="btn btn-success">UnBan</button>
                                               @csrf
                                            </form>
                                        @else
                                            <span>Active</span>
                                            <form action="{{route('admin.ban', $user->id)}}" style="display: inline; margin-left: 20px" method="post">
                                                @csrf
                                               <button class="btn btn-danger">Ban</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
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
                                    <td>{{$user->country ? $user->country->name : ''}}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{$user->city ? $user->city->name: ''}}</td>
                                </tr>
                                <tr>
                                    <td>Neighborhood</td>
                                    <td>{{$user->neighborhood ? $user->neighborhood->name : ''}}</td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            @if ($user->type == "teacher")
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            Bank/Paypal Information
                        </div>

                        <div class="box-body">
                            <table class="table table-hover" style="background: #fff">
                                <tbody>

                                    <tr>
                                        <td>Paypal</td>
                                        <td>{{$user->profile->paypal}}</td>
                                    </tr>
                                    <tr>
                                        <td>Bank</td>
                                        <td>{{$user->profile->payment}}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif
            @if ($user->type == "teacher")
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="box-title">
                                    Payments
                                </div>

                                <div class="box-body">
                                    <table class="table table-hover" style="background: #fff">
                                        <tbody>
                                            <tr>

                                                <th>ID</th>
                                                <th>Paypal Transcation ID</th>
                                                <th>Amount Paid</th>
                                                <th>Date</th>
                                            </tr>
                                            @foreach ($user->profile->payments as $payment)
                                                <tr>
                                                    <td>{{$payment->id}}</td>
                                                    <td>
                                                        {{$payment->proff}}
                                                    </td>
                                                    <td>${{$payment->amount}}</td>
                                                    <td>${{$payment->created_at}}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 hidden">
                        <div class="box">
                            <div class="box-header">
                                <div class="box-title">
                                    Add Payment {{$user->country->name == "United States" ? "USD" : "CAD"}}
                                </div>

                                <div class="box-body">
                                    <form action="{{route('admin.post.payment')}}" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name">Amount $</label>
                                            <input type="number" class="form-control" name="amount" placeholder="Payment Amount" value="{{old('amount')}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Proff Attachment</label>
                                            <input type="file" class="form-control" name="image" placeholder="Payment Amount" accept="image/png, image/jpeg, image/jpg" value="{{old('amount')}}">
                                        </div>

                                        <input type="hidden" name="teacher" value="{{$user->profile->id}}">
                                        {{ csrf_field() }}
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



        </div>

    </div>
@endsection
