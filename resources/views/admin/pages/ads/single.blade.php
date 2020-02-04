@extends('admin.layouts.master')
@section('title')
Session  | Admin Panel
@endsection()
@section('content')
    <div class="container">
        <div class="col-md-12">

                
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Ad Information
                    </div>

                    <div class="box-body">
                        <table class="table table-hover" style="background: #fff">
                            <tbody>
                                
                                <tr>
                                    <td>Title</td>
                                    <td>{{$ad->title}}</td>
                                </tr>
                               
                                <tr>
                                    <td>Description</td>
                                    <td>${{$ad->description}}</td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>{{$ad->discipline->name}}</td>
                                </tr>
                                <tr>
                                    <td>Level</td>
                                    <td>{{$ad->level->name}}</td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
           
            

            


        </div>
       
    </div>
@endsection
