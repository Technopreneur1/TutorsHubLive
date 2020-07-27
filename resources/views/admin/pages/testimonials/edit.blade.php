@extends('admin.layouts.master')
@section('title')
    Edit Testimonial | Adminpanel
@endsection()
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Testimonial</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                    <form action="{{route('admin.testimonial.update', $testimonial->id)}}" method="POST">
                        <div class="form-group">
                            <label for="">Name*</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="Author Name" required value="{{$testimonial->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Title*</label>
                            <input type="text" name="title" id="" class="form-control" placeholder="Enter Your Title" required value="{{$testimonial->title}}">
                        </div>
                        <div class="form-group">
                            <label for="">Body*</label>
                            <input type="text" name="body" id="" class="form-control" placeholder="Type your Message" required value="{{$testimonial->comment}}">
                        </div>
                        <div class="form-group">
                            <label for="">Age*</label>
                            <input type="text" name="age" id="" class="form-control" placeholder="Age" required value="{{$testimonial->age}}">
                        </div>
                        @csrf
                        <div class="form-group">
                            <button class="btn btn-info">Update</button>
                        </div>
                    </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </div>



@endsection

@section('scripts')
@endsection
