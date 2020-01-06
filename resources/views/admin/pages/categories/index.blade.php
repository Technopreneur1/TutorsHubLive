@extends('admin.layouts.master')
@section('title')
Categories
@endsection()
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                    <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('add.category')}}" method="POST">
                            <div class="form-group">
                              <label for="">Name*</label>
                              <input type="text" name="name" id="" class="form-control" placeholder="Category Name" required>
                            </div>
                            <div class="form-group">
                              <label for="">Type*</label>
                              <select name="type" class="form-control" required>
                                  <option value="" selected disabled>Select Type</option>
                                  <option value="insights">Insight</option>
                                  <option value="product">Product</option>
                              </select>
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
                <h3 class="box-title">Insight</h3>
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
                        @foreach ($icategories as $category)
                        <tr>
                            <td><b>{{$category->name}}</b></td>
                            <td>{{$category->created_at->diffForHumans()}} </td>
                            <td>
                                <a href="{{route('edit.category', $category->id)}}" class="btn btn-success">Edit</a>
                                @if (!$category->insights->count())
                                    <form style="display: inline"  action="{{route('destroy.category', $category->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Are you sure? You want to delete this Product')" class="btn btn-danger">Delete</button>
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
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Product</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pcategories as $category)
                        <tr>
                            <td><b>{{$category->name}}</b></td>
                            <td>{{$category->created_at->diffForHumans()}} </td>
                            <td>
                                <a href="{{route('edit.category', $category->id)}}" class="btn btn-success">Edit</a>
                                @if (!$category->products->count())
                                    <form style="display: inline"  action="{{route('destroy.category', $category->id)}}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Are you sure? You want to delete this Product')" class="btn btn-danger">Delete</button>
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
