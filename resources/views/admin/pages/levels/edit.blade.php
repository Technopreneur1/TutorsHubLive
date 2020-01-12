@extends('admin.layouts.master')
@section('title')
Edit Level | Adminpanel
@endsection()
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Edit Level</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('admin.level.update', $level->id)}}" method="POST">
                            <div class="form-group">
                              <label for="">Name*</label>
                              <input type="text" name="name" id="" class="form-control" placeholder="Level Name" required value="{{$level->name}}">
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
