@extends('layouts.admin')
@section('admin_content')
@include('block.notification')

<h2 class="text-center">List Orders</h2>
<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>Customer's Name</th>
            <th>Total Price</th>
            <th>Date Ordered</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->User->name}}</td>
            <td>{{ $order->order_total }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->order_status }}</td>           
            <td>
                <a href="{{URL::to('/view-order/'.$order->id)}}" class="active styling-edit" ui-toggle-class="">
                    <i class="fa fa-eye text-success text-active"style="font-size: 30px"></i>
                </a>
                <span style="font-size: 30px">|</span>
                <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')"
                    href="{{URL::to('/delete-order/'.$order->id)}}" class="active styling-edit">
                    <i class="fa fa-times text-danger text" style="font-size: 30px"></i>
                </a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection