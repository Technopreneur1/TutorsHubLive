@extends('admin.layouts.master')
@section('title')
Topics
@endsection()
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Add Topic</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('add.topic')}}" method="POST">
                            <div class="form-group">
                              <label for="">Name*</label>
                              <input type="text" name="name" id="" class="form-control" placeholder="Topic Name" required>
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


        <div class="col-md-6 col-md-offset-3">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">T</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($topics as $topic)
                            <tr>
                                <td><b>{{$topic->id}}</b></td>
                                <td><b>{{$topic->name}}</b></td>
                                <td>{{$topic->created_at->diffForHumans()}} </td>
                                <td>
                                    <a href="{{route('edit.topic', $topic->id)}}" class="btn btn-success">Edit</a>
                                    @if (!$topic->threads->count())
                                        <form style="display: inline"  action="{{route('destroy.topic', $topic->id)}}" method="post">
                                            @csrf
                                            <button onclick="return confirm('Are you sure? You want to delete this Topic')" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
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
</script>
@endsection
