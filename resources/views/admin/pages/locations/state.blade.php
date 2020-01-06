@extends('admin.layouts.master')
@section('title')
{{$state->name}}
@endsection()
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Cities Of {{$state->name}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Added At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($state->cities as $location)
                    <tr>
                        <td>{{$location->id}}</td>
                        <td>{{$location->name}}</td>
                        <td>{{$location->created_at ? $location->created_at->diffForHumans() : ''}}</td>
                        <td>
                            {{-- <a href="" class="btn btn-success">View</a> --}}
                            <a href="{{route('admin.city', $location->id)}}" class="btn btn-success">View</a>
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
        <div class="col-md-5">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Add New City </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{route('admin.add.country')}}" method="POST">
                        <div class="form-group">
                            <label for="">Name*</label>
                            <input type="text" name="name" id="" class="form-control" placeholder="City Name" required>
                        </div>
                        <input type="hidden" name="type" value="city">
                        <input type="hidden" name="parent_id" value="{{$state->id}}">
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
    

@endsection

@section('scripts')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}" charset="utf-8"></script>
<script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}" charset="utf-8"></script>
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}" charset="utf-8"></script>
<script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}" charset="utf-8"></script>
<script>
  $(function () {
    $('table').DataTable({
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
