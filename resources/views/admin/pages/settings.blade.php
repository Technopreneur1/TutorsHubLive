@extends('admin.layouts.master')
@section('title')
Settings
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

  </div>

@endsection
