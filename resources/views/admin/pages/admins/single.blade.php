@extends('admin.layouts.master')
@section('title')
Add New Admin  | Admin Panel
@endsection()
@section('content')
    <div class="container">
        <div class="col-md-12">
            
            <div class="col-md-5">
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            Change Password
                        </div>
    
                        <div class="box-body">
                            <form action="{{route('admin.update.password')}}" method="post">
                                
                                
                                <div class="form-group">
                                    <label for="password">Current Password</label>
                                    <input type="password" class="form-control" name="current" placeholder="Current Password" >
                                </div>

                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" >
                                </div>
                                
                            
                                {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
            


        </div>
       
    </div>
@endsection
