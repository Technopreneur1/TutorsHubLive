@extends('admin.layouts.master')
@section('title')
Session  | Admin Panel
@endsection()
@section('content')
    <div class="container">
        <div class="col-md-12">

            @if (!$session->completed)
                <form action="{{route('admin.cancel.session')}}" method="post">
                    <input type="hidden" name="id" value="{{$session->id}}">
                    @csrf
                    @if(!$session->cancel_request)
                        <button class="btn btn-danger">Cancel Session</button>
                    @endif
                </form>
            @endif
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Session Information
                    </div>

                    <div class="box-body">
                        <table class="table table-hover" style="background: #fff">
                            <tbody>

                            Requested -> Not accepted
                            Pending -> Accepted but Not paid
                            Upcoming -> Accepted and Paid but not completed
                            Completed -> completed
                            cancelled -> cancel_request

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        {{ !$session->accept ? 'Requested' : '' }}
                                        {{ ($session->accept && !$session->payment_status && !$session->completed && !$session->cancel_request) ? 'Pending' : ''  }}
                                        {{ ($session->accept && $session->payment_status && !$session->completed && !$session->cancel_request) ? 'Upcoming' : ''  }}
                                        {{ ($session->accept && $session->payment_status && $session->completed && !$session->cancel_request) ? 'Completed' : ''  }}
                                        {{ ($session->cancel_request) ? 'Cancelled' : ''  }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Student</td>
                                    <td><a href="{{route('admin.user', $session->student->user->id)}}">{{$session->student->user->name}}</a></td>
                                </tr>
                                <tr>
                                    <td>Tutor</td>
                                    <td><a href="{{route('admin.user', $session->teacher->user->id)}}">{{$session->teacher->user->name}}</a></td>
                                <tr>
                                    <td>Level</td>
                                    <td>{{$session->level}}</td>
                                </tr>
                                <tr>
                                    <td>Subject/Discipline</td>
                                    <td>{{$session->subject}}</td>
                                </tr>
                                <tr>
                                    <td>Hours</td>
                                    <td>{{$session->hours}}</td>
                                </tr>
                                <tr>
                                    <td>Rate</td>
                                    <td>${{$session->rate}}</td>
                                </tr>
                                <tr>
                                    <td>Fee</td>
                                    <td>${{$session->fee}}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>${{$session->total}}</td>
                                </tr>



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            @if ($session->completed)
                <div class="box">
                    <div class="box-header">
                        <div class="box-title">
                            Reviews
                        </div>

                        <div class="box-body">
                            <table class="table table-hover" style="background: #fff">
                                <tbody>

                                    <tr>
                                        <td>Tutor Rating (By Student)</td>
                                        <td>{{$session->tutor_rating}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tutor Review (By Student)</td>
                                        <td>{{$session->tutor_review}}</td>
                                    </tr>

                                    <tr>
                                        <td>Student Rating (By Tutor)</td>
                                        <td>{{$session->student_rating}}</td>
                                    </tr>
                                    <tr>
                                        <td>Student Review (By Student)</td>
                                        <td>{{$session->student_review}}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            @endif

            @if($session->cancel_request)
                <div class="alert alert-danger">
                    Cancelled By: {{ $session->cancel_request }}
                </div>
            @endif

        </div>

    </div>
@endsection
