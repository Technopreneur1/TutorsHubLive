@extends('admin.layouts.master')
@section('title')
Edit Page
@endsection()
@section('styles')
  <link rel="stylesheet" href="{{asset('admin/css/jquery-ui.css')}}">
@endsection
@section('content')

  <div class="conatiner">
    <form action="{{route('admin.cms.update', $cms->id)}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="col-md-8">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title text-center">Edit page</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" required class="form-control" name="title" placeholder="Title" value="{{$cms->title}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Description</label>
                          {{-- <textarea name="description"  class="form-control my-editor" cols="30" rows="30"></textarea> --}}
                          <textarea name="description" rows="20" class="form-control my-editor">{{$cms->description}}</textarea>
                        </div>
                    </div>
                    <div class="box-body">
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                  </div>
                </div><!-- col -->
            </div>
        </div>
    </div>
    </form>
  </div>

@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/jgxoowtiuynry3kakgipyamx65h0fps1s8b7yj8yhbal78lm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection
