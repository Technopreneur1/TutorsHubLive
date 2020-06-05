@extends('layouts/master')
@section('title')
My Files
@endsection()
@section('content')
    <div class="files-page">
        <div class="container">
            <div class="title">My Files</div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    @if (auth()->user()->type == 'teacher' && !auth()->user()->verified && (auth()->user()->profile->background_check || auth()->user()->profile->resume || auth()->user()->profile->identity))
                        <a href="{{route('myfiles')}}" style="display: block">
                            <div  class="alert alert-info text-center">
                                Thanks For uploading all files. After verifying your documents we will assign you the verified badge.
                            </a>
                        </div>
                    @endif
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Resume</th>
                                @if (!auth()->user()->profile->resume)
                                    <form action="{{route('upload.file', 'resume')}}" method="post" enctype="multipart/form-data">
                                        <td class="text-right">
                                            @csrf
                                            <input type="file" onchange="form.submit()" name="file" value="Upload" class="btn btn-primary">
                                        </td>
                                    </form>
                                @else
                                    <td class="text-right">
                                        <a href="{{asset('storage/files') . '/'. auth()->user()->profile->resume}}"  target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a> &nbsp;
                                        <form action="{{route('delete.file', 'resume')}}" method="post" style="display: inline">
                                            @csrf
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">Background Check</th>
                                @if (!auth()->user()->profile->background_check)
                                    <form action="{{route('upload.file', 'background_check')}}" method="post" enctype="multipart/form-data">
                                        <td class="text-right">
                                            @csrf
                                            <input type="file" onchange="form.submit()" name="file" value="Upload" class="btn btn-primary">
                                        </td>
                                    </form>
                                @else
                                    <td class="text-right">
                                        <a href="{{asset('storage/files') . '/'. auth()->user()->profile->background_check}}"  target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a> &nbsp;
                                        <form action="{{route('delete.file', 'background_check')}}" method="post" style="display: inline">
                                            @csrf
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">ID</th>
                                @if (!auth()->user()->profile->identity)
                                    <form action="{{route('upload.file', 'identity')}}" method="post" enctype="multipart/form-data">
                                        <td class="text-right">
                                            @csrf
                                            <input type="file" onchange="form.submit()" name="file" value="Upload" class="btn btn-primary">
                                        </td>
                                    </form>
                                @else
                                    <td class="text-right">
                                        <a href="{{asset('storage/files') . '/'. auth()->user()->profile->identity}}"  target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a> &nbsp;
                                        <form action="{{route('delete.file', 'identity')}}" method="post" style="display: inline">
                                            @csrf
                                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection