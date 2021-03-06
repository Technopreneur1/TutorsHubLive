@extends('admin.layouts.master')
@section('title')
Add Series
@endsection()
@section('styles')
  <link rel="stylesheet" href="{{asset('admin/css/jquery-ui.css')}}">
@endsection
@section('content')

  <div class="conatiner">
    <form action="{{route('post.series')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="col-md-8">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title text-center">Add Series</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{old('title')}}">
                        </div>
                        <div class="form-group">
                          <label for="name">Theme</label>
                          <input type="text" class="form-control" name="theme" placeholder="Theme" value="{{old('theme')}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Address/Location</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{old('address')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Date</label>
                                    <input type="date" class="form-control" name="date" value="{{old('date')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Time</label>
                                    <input type="time" class="form-control" name="time" value="{{old('time')}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="name">Description</label>
                          <textarea name="description" rows="20" class="form-control my-editor"></textarea>
                        </div>
                    </div>

                  </div>
                </div><!-- col -->
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-body">

                                <div class="form-group">
                                    <label for="name">Product ID:</label>
                                    <input type="number" name="product_id" class="form-control">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Flyer</label>
                                    <input type="file" name="flyer" class="btn btn-info">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Gallery <small>(Select Multiple Files at once)</small> </label>
                                    <input type="file" name="gallery[]" class="btn btn-info" multiple>
                                </div>
                                <hr>
                                @csrf
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Publish</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
  </div>

@endsection
@section('scripts')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>

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
