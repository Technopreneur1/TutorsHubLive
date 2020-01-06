@extends('dashboard')
@section('title')
Add New Client
@endsection()
@section('styles')
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@endsection
@section('content')

  <div class="conatiner">
    <div class="row">
      <div class="col-md-5 col-md-offset-3">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-center">Add New Client</h3>
          </div>
          <div class="box-body">
            <form action="{{route('postclient')}}" method="post">
              <div class="form-group">
                <label for="name">Client Name</label>
                <input type="text" class="form-control" name="name" placeholder="Client's Name" value="{{old('name')}}">
              </div>
              <div class="form-group">
                <label for="name">Client email</label>
                <input type="email" class="form-control" name="email" placeholder="Client's Email" value="{{old('email')}}">
              </div>
              <div class="form-group">
                <label for="name">Client Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Client's Phone" value="{{old('phone')}}">
              </div>
              <div class="form-group">
                <label for="name">Client Address</label>
                <input type="text" class="form-control" name="address" placeholder="Client's Address" value="{{old('address')}}">
              </div>
              <div class="form-group">
                <label for="name">Service</label>
                <input type="text" class="form-control" name="service" placeholder="Client's Service" value="{{old('service')}}">
              </div>
              <div class="form-group text-right">
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
