@extends('admin.layouts.master')
@section('title')
{{$type}}
@endsection()
@section('styles')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css"> --}}
@endsection

@section('content')

    <div class="search">
      <div class="row">
        <div class="col-md-4 col-xs-8">
          <form action="{{ $type == 'tutors' ?  route('admin.tutors') : route('admin.students')}}">
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
            <a href="{{route('admin.tutors')}}" class="btn btn-info">Reset</a>
          </div>
        @endif
      </div>
    </div>

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
            <th>Joined <small>Y-M-D</small> </th>
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
                <td>{{$user->created_at->format("Y-m-d")}}</td>
                {{-- <td>{{$user->created_at->diffForHumans()}}</td> --}}
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
      'select'      : true,
      'autoWidth'   : false
    });
  })

</script>
</script>
@endsection
