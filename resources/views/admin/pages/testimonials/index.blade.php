@extends('admin.layouts.master')
@section('title')
    Testimonials | Adminpanel
@endsection()
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Add Testimonial</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('admin.add.testimonials')}}" method="POST">
                            <div class="form-group">
                                <label for="">Author Name*</label>
                                <input type="text" name="name" id="" class="form-control" placeholder="Author Name" required>
                            </div>
                            <div class="form-group">
                                <label for="">Title*</label>
                                <input type="text" name="title" id="" class="form-control" placeholder="Enter Your Title" required>
                            </div>
                            <div class="form-group">
                                <label for="">Body*</label>
                                <input type="text" name="body" id="" class="form-control" placeholder="Type your Message" required>
                            </div>
                            <div class="form-group">
                                <label for="">Age*</label>
                                <input type="text" name="age" id="" class="form-control" placeholder="Age" required>
                            </div>
                            @csrf
                            <div class="form-group">
                                <button class="btn btn-info">Publish</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>


        <div class="col-sm-12 ">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Testimonials</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Age</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($testimonials as $testimonial)
                            <tr>
                                <td><b>{{$testimonial->name}}</b></td>
                                <td><b>{{$testimonial->title}}</b></td>
                                <td><b>{{$testimonial->comment}}</b></td>
                                <td><b>{{$testimonial->age}}</b></td>
                                <td>{{$testimonial->created_at ? $testimonial->created_at->format("Y-m-d") : ''}} </td>
                                <td>
                                    <a href="{{route('admin.testimonial.edit', $testimonial->id)}}" class="btn btn-success">Edit</a>
                                        <form style="display: inline"  action="{{route('admin.testimonial.delete', $testimonial->id)}}" method="post">
                                            @csrf
                                            <button onclick="return confirm('Are you sure? You want to delete this Discipline')" class="btn btn-danger">Delete</button>
                                        </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>



@endsection

@section('scripts')
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('admin/js/jquery.dataTables.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}" charset="utf-8"></script>
    <script>
        $(function () {
            $('#example1').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });
        })

    </script>

@endsection
