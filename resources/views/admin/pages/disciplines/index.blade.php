@extends('admin.layouts.master')
@section('title')
Disciplines | Adminpanel
@endsection()
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Add Discipline</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('admin.add.discipline')}}" method="POST">
                            <div class="form-group">
                              <label for="">Discipline Name*</label>
                              <input type="text" name="name" id="" class="form-control" placeholder="Discipline Name" required>
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


        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Disciplines</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($disciplines as $discipline)
                        <tr>
                            <td><b>{{$discipline->name}}</b></td>
                            <td>{{$discipline->created_at ? $discipline->created_at->format("Y-m-d") : ''}} </td>
                            <td>
                                <a href="{{route('admin.discipline.edit', $discipline->id)}}" class="btn btn-success">Edit</a>
                                @if (!$discipline->students()->count() && !$discipline->plans()->count() && !$discipline->ads()->count())
                                    <form style="display: inline"  action="{{route('admin.discipline.delete', $discipline->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Are you sure? You want to delete this Discipline')" class="btn btn-danger">Delete</button>
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
