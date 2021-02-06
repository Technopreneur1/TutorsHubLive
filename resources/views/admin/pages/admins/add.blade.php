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
                            Create Admin
                        </div>
    
                        <div class="box-body">
                            <form action="{{route('admin.post.admin')}}" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Admin Name" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Admin Email" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" name="phone" placeholder="Admin Email" value="{{old('phone')}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" >
                                </div>
                                
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
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
