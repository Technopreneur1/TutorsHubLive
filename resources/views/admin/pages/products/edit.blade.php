@extends('admin.layouts.master')
@section('title')
Edit Product
@endsection()
@section('styles')
  <link rel="stylesheet" href="{{asset('admin/css/jquery-ui.css')}}">
  <style>
      .thmb{
            background: #000000;
            margin-bottom: 4px;
            padding: 4px;
            position: relative;

      }
      .thmb form{
          display: inline;
          position: absolute;
          top: 5px;
          right: 5px;
      }
  </style>
@endsection
@section('content')

  <div class="conatiner">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <form action="{{route('update.product', $product->id)}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title text-center">Edit Product</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                          <label for="name">Title</label>
                          <input type="text" class="form-control" name="title" placeholder="Title" value="{{$product->title}}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="Price" value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Discount</label>
                                    <input type="number" class="form-control" name="discount" value="{{$product->discount}}" placeholder="Discount (e.g 50)">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="name">Type</label>
                                    <select class="form-control" name="type" id="">
                                       <option value="Digital" {{$product->type == "Digital" ? "selected" : ""}} >Digital</option>
                                       <option value="Physical" {{$product->type == "Physical" ? "selected" : ""}}>Physical (Ask Shipping Details)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="name">Description</label>
                          <textarea name="description" rows="20" class="form-control my-editor">{{$product->description}}</textarea>
                        </div>
                    </div>

                  </div>
                </div><!-- col -->
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-body">
                                <div class="form-group">
                                    <label for="name">Category</label>
                                    <select class="form-control" name="category" id="">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{$product->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Status</label>
                                    <select class="form-control" name="is_active" id="">
                                       <option value="1" {{$product->is_active ? "selected" : ""}} >Active</option>
                                       <option value="0" {{!$product->is_active ? "selected" : ""}}>Out Of Stock</option>
                                    </select>
                                </div>
                                <hr>
                                <div style="max-width: 300px; margin: 0 auto 15px auto">
                                    <img class="img-responsive" src="{{asset('storage/product') . '/' . $product->thumbnail}}" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Change Featured Image</label>
                                    <input type="file" name="image" class="btn btn-info">
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="name">Add More Photos To Gallery <small>(Select Multiple Files at once)</small> </label>
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
        </form>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header">Edit Gallery</div>
                    <div class="box-body">
                        <div class="row">
                            @foreach ($product->images as $image)
                                <div class="col-md-4">
                                    <div class="thmb">
                                        <img class="img-responsive" src="{{asset('storage/product') . '/' . $image->src}}" alt="">
                                        <form action="{{route('delete.pimg', $image->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
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
