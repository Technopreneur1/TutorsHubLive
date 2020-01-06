@extends('admin.layouts.master')
@section('title')
Order | Admin Panel
@endsection()
@section('content')
    <div class="container">
        <div class="col-md-8">

            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Order Information
                    </div>

                    <div class="box-body">
                        <table class="table table-hover" style="background: #fff">
                            <tbody>
                                <tr>
                                    <td>Ordered By </td>
                                    <td><a target="_blank" href="{{route('user', $order->user->id)}}">{{$order->user->firstname . " " . $order->user->lastname}}</a></td>
                                </tr>
                                <tr>
                                    <td>Order ID</td>
                                    <td>{{$order->id}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{$order->phone}}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{$order->city}}</td>
                                </tr>
                                <tr>
                                    <td>Postcode</td>
                                    <td>{{$order->postcode}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$order->address}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{$order->status}}</td>
                                </tr>
                                <tr>
                                    <td>Admount Paid</td>
                                    <td>₦{{$order->paid}}</td>
                                </tr>
                                <tr>
                                    <td>Paystack Referance</td>
                                    <td>{{$order->reference}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        Order Items
                    </div>

                    <div class="box-body">
                        <table class="table table-hover" style="background: #fff">
                            <tbody>
                                <tr>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Unit Price</td>
                                </tr>
                                @foreach ($order->items as $item)
                                <tr>
                                    <td><a href="{{route('product.show.front', $item->product->slug)}}">{{$item->product->title}}</a></td>
                                    <td>{{$item->quantity}}</td>
                                    <td>₦{{$item->unit_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-body">
                    <form action="{{route('change-order-status', $order->id)}}" method="post">
                        <div class="form-group">
                            <label for="">Change Order Status</label>
                            <select class="form-control" name="status">
                              <option value="Complete" {{$order->status == "Complete" ? "selected" : ""}}>Complete</option>
                              <option value="Complete" {{$order->status == "Processing" ? "selected" : ""}}>Processing</option>
                            </select>
                            @csrf
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
