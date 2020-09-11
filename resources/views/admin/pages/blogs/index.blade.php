@extends('admin.layouts.master')
@section('title')
blogs
@endsection()
@section('content')

    <div class="box">
        <div class="box-header">
        <h3 class="box-title">Blogs</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Pubished</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>{{$blog->title}}</td>
                <td>{{App\Time::convertTime($blog->created_at)->diffForHumans()}} </td>
                <td>
                    <a href="{{route('blog.view', $blog->id)}}" target="_blank" class="btn btn-info">view</a>
                    <a href="{{route('admin.blogs.edit', $blog->id)}}" class="btn btn-success">Edit</a>
                    <form style="display: inline"  action="{{route('admin.blogs.destroy', $blog->id)}}" method="post">
                        @csrf
                        <button onclick="return confirm('Are you sure? You want to delete this post')" class="btn btn-danger">Delete</button>
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
