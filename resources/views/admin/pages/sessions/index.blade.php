@extends('admin.layouts.master')
@section('title')
Sessions
@endsection()
@section('content')
    <div style="margin: 10px 0" >
      <a class="btn btn-primary" href="{{route('export.sessions')}}">Export</a>
    </div>
    <div class="box">
        <div class="box-header">
        <h3 class="box-title">{{$sessionTitle ? : ''}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Teacher</th>
            <th>Rate</th>
            <th>Hours</th>
            <th>Fee</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($sessions as $session)
                @continue(!$session->student->user)
                <tr>
                <td>{{$session->id}}</td>
                <td><a href="{{route('admin.user', $session->student->user->id)}}">{{$session->student->user->name}}</a></td>
                <td><a href="{{route('admin.user', $session->teacher->user->id)}}">{{$session->teacher->user->name}}</a></td>
                <td>${{$session->rate}} </td>
                <td>{{$session->hours}} </td>
                <td>${{$session->fee}} </td>
                <td>{{$session->created_at->format("Y-m-d")}}</td>
                <td>
                    {{ !$session->accept ? 'Requested' : '' }}
                    {{ ($session->accept && !$session->payment_status && !$session->completed && !$session->cancel_request) ? 'Pending' : ''  }}
                    {{ ($session->accept && $session->payment_status && !$session->completed && !$session->cancel_request) ? 'Upcoming' : ''  }}
                    {{ ($session->accept && $session->payment_status && $session->completed && !$session->cancel_request) ? 'Completed' : ''  }}
                    {{ ($session->cancel_request) ? 'Cancelled' : ''  }}
                </td>
                <td>
                    {{-- {{-- <a href="{{route('admin.session', $session->id)}}" class="btn btn-success">Open</a> --}}
                    <a href="{{route('admin.session.view', $session->id)}}" class="btn btn-info">View</a>
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
      'select'      : true,
      'autoWidth'   : false
    });
  })

</script>
</script>
@endsection
