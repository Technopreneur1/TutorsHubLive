@extends('admin.layouts.master')
@section('title')
Ads
@endsection()
@section('content')

<div class="search">
  <div class="row">
    <div class="col-md-4 col-xs-8">
      <form action="{{ route('admin.ads')}}">
        <div class="form-group">
          @if (!request()->country &&  !request()->state && !request()->city)
            {{-- <label for="">Country</label> --}}
            <select class="form-control" name="country" onchange="form.submit()" id="">
              <option value="">Country</option>
              @foreach (App\Location::where('type', 'country')->get() as $loc)
                <option value="{{$loc->id}}">{{$loc->name}}</option>
              @endforeach
            </select>
          @endif
          @if (request()->country && !request()->state && !request()->city)
            {{-- <label for="">City</label> --}}
            <select class="form-control" name="state" onchange="form.submit()" id="">
              <option value="">State/Province</option>
              @foreach (App\Location::where('type', 'state')->get() as $loc)
                <option value="{{$loc->id}}">{{$loc->name}}</option>
              @endforeach
            </select>
          @endif
          @if (request()->state && !request()->city)
            {{-- <label for="">State</label> --}}
            <select class="form-control" name="city" onchange="form.submit()" id="">
              <option value="">City</option>
              @foreach (App\Location::where('type', 'city')->get() as $loc)
                <option value="{{$loc->id}}">{{$loc->name}}</option>
              @endforeach
            </select>
          @endif
          @if (request()->city)
            {{-- <label for="">City</label> --}}
            <select class="form-control" name="state" onchange="form.submit()" id="">
              <option value="">Neighborhood</option>
              @foreach (App\Location::where('type', 'neighborgood')->get() as $loc)
                <option value="{{$loc->id}}">{{$loc->name}}</option>
              @endforeach
            </select>
          @endif
      </div>
      </form>
    </div>
    @if (request()->all())
      <div class="col-4">
        <a href="{{route('admin.ads')}}" class="btn btn-info">Reset</a>
      </div>
    @endif
  </div>
</div>

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
                <td>{{$ad->created_at->format("Y-m-d")}}</td>
                <td>
                    {{-- {{-- <a href="{{route('admin.ad', $ad->id)}}" class="btn btn-success">Open</a> --}}
                    <a href="{{route('admin.ad.view', $ad->id)}}" class="btn btn-info">View</a>
                    <form action="{{route('admin.delete.ad', $ad->id)}}" method="POST" style="display: inline;">
                        @csrf
                        <button onclick="confirm('Are you sure you want to delete this ad')" class="btn btn-danger">Delete</button>
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
