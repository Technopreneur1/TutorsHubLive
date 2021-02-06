@extends('admin.layouts.master')
@section('title')
Insights
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">Inisghts</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Pubished</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($insights as $insight)
            <tr>
                <td>{{$insight->title}}</td>
                <td>{{$insight->category->name}}</td>
                <td>{{$insight->created_at->format("Y-m-d")}} </td>
                <td>
                    <a href="{{route('insight.show.front', $insight->slug)}}" target="_blank" class="btn btn-info">view</a>
                    <a href="{{route('edit.insight', $insight->id)}}" class="btn btn-success">Edit</a>
                    <form style="display: inline"  action="{{route('destroy.insight', $insight->id)}}" method="post">
                        @csrf
                        <button onclick="return confirm('Are you sure? You want to delete this record')" class="btn btn-danger">Delete</button>
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
