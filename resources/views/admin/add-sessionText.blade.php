@extends('admin.layouts.master')

@section('title')
    Add Session Text
@endsection()

@section('content')

    <div class="conatiner">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title text-center">Add Session Text</h3>
                    </div>
                    <div class="box-body">
                        <form action="{{route('admin.store-session-text')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Session Text</label>
                                <textarea type="text"
                                          class="form-control"
                                          name="text"
                                          placeholder="Add text that will be visible below sessions">{{old('text') ? : $sessionText}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info mt-1">Submit</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
