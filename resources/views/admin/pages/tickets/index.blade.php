@extends('admin.layouts.master')
@section('title')
Tickets
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">Tickets</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>query</th>
            <th>Posted</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{$ticket->ticket_id}}</td>
                @if ($ticket->user_id)
                  <td><a href="{{route("admin.user", $ticket->user_id)}}">{{$ticket->user->name}}</a></td>
                @else
                  <td>{{$ticket->user_type}}</td>
                @endif
              <td>{{$ticket->email}} </td>
              <td>{{$ticket->query}} </td>
              <td>{{$ticket->created_at->diffForHumans()}}</td>
              <td>
                @if ($ticket->user_id)
                  <a href="{{route("admin.contact",[ $ticket->user->id, $ticket->ticket_id])}}" class="btn btn-success">Message User</a>
                @endif
                  {{-- <a href="{{route('admin.ticket', $ticket->id)}}" class="btn btn-success">Open</a>
                  <a href="{{route('ticketProfile', $ticket->id)}}" target="_blank" class="btn btn-info">Profile</a> --}}
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
