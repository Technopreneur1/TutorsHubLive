@extends('admin.layouts.master')
@section('title')
{{$type}}
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">{{$type}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Joined</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}} </td>
                <td>{{$user->gender}} </td>
                <td>{{$user->created_at->diffForHumans()}}</td>
                <td>
                    <a href="{{route('admin.user', $user->id)}}" class="btn btn-success">Open</a>
                    <a href="{{route('userProfile', $user->id)}}" target="_blank" class="btn btn-info">Profile</a>
                </td>
            </tr>
            @endforeach

            </tbody>

        </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

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
