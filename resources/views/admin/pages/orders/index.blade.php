@extends('admin.layouts.master')
@section('title')
Orders
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">Users</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>ID</th>
            <th>By</th>
            <th>Item(s)</th>
            <th>Status</th>
            <th>Ordered At</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr style="{{!$order->seen ? 'background: #ffa3a3;' : ''}}">
                <td>{{$order->id}}</td>
                <td><a href="{{route('user', $order->user->id)}}">{{$order->user->firstname . " " . $order->user->lastname}}</a></td>
                <td>{{$order->items->count() == 1 ? $order->items[0]->product->title  : $order->items[0]->product->title . " (" .$order->items->count() . " more)"}}</td>
                <td>{{$order->status}} </td>
                <td>{{$order->created_at->format("Y-m-d")}}</td>
                <td>
                    <a href="{{route('order', $order->id)}}" class="btn btn-info">view</a>
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
