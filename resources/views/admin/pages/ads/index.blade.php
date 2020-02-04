@extends('admin.layouts.master')
@section('title')
ads 
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">All ads</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>ID</th>
            <th>Title</th>
            <th>By</th>
            <th>Posted</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($ads as $ad)
            <tr>
                <td>{{$ad->id}}</td>
                <td>{{$ad->title}}</td>
                <td><a href="{{route('admin.user', $ad->user->id)}}">{{$ad->user->name}}</a></td>
                <td>{{$ad->created_at->diffForHumans()}}</td>
                <td>
                    {{-- {{-- <a href="{{route('admin.ad', $ad->id)}}" class="btn btn-success">Open</a> --}}
                    <a href="{{route('admin.ad.view', $ad->id)}}" class="btn btn-info">View</a>
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
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    });
  })

</script>
</script>
@endsection
