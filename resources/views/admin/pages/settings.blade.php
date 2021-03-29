@extends('admin.layouts.master')
@section('title')
Settings
@endsection()
@section('styles')
  <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@endsection
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-5 col-md-offset-3">
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title text-center">Fee/Commision Per Session</h3>
              </div>
              <div class="box-body">
                  <form action="{{route('admin.update.fee')}}" method="post">
                      <div class="form-group">
                          <label for="name">Percentage e.g 5 for 5%</label>
                          <input type="text" class="form-control" name="fee" placeholder="%" value="{{$fee ? $fee->value : ''}}">
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

    <div class="row">
        <div class="col">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title text-center">Site Settings</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('admin.update.settings')}}" method="post">
                        <div class="form-group">
                            <label for="name">Copyright Text</label>
                            <input type="text" required class="form-control" name="copyrightText" placeholder="2021 All rights reserved" value="{{$settings ? ($settings->copyrightText ? : '') : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="name">Presentation Video URL</label>
                            <input type="text" required class="form-control" name="videoURL" placeholder="https://www.youtube.com...." value="{{$settings? ($settings->videoURL ? : '') : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="name">Contact Number</label>
                            <input type="text" required class="form-control" name="contact_number" placeholder="Contact Number" value="{{$settings? ($settings->contact_number ? : '') : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="name">Email Address</label>
                            <input type="text" required class="form-control" name="email" placeholder="Email Address" value="{{$settings? ($settings->email ? : '') : ''}}">
                        </div>

                        <div class="form-group">
                            <label for="name">Address</label>
                            <textarea class="form-control" name="address" id="address" cols="20" rows="5" placeholder="Address" required >{{$settings? ($settings->address ? : '') : ''}}</textarea>
                        </div>

                        <div class="form-group text-right">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
  </div>

@endsection
