@extends('layouts.admin')
@section('admin_content')
@include('block.notification')

<div>
    <h2 class="text-center">LOGIN INFORMATION</h2>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Customer's Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order_by_id->User->name}}</td>
                <td>{{ $order_by_id->User->email}}</td>
                <td>{{ $order_by_id->User->phone}}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<hr>
<br>
<div>
    <h2 class="text-center">SHIPPING INFORMATION</h2>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Customer's Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Note</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order_by_id->Shipping->shipping_name}}</td>
                <td>{{ $order_by_id->Shipping->shipping_address}}</td>
                <td>{{ $order_by_id->Shipping->shipping_phone}}</td>
                <td>{{ $order_by_id->Shipping->shipping_email}}</td>
                <td>{{ $order_by_id->Shipping->shipping_desc}}</td>
                <td>
                    @if($order_by_id->Payment->payment_method == 1)
                    Direct Bank Transfer
                    @elseif($order_by_id->Payment->payment_method == 2)
                    Pay by Cash
                    @elseif($order_by_id->Payment->payment_method == 3)
                    Pay by Debit Card
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<hr>
<br>
<div>
    <h2 class="text-center">ORDER DETAILS</h2>
    <table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Product's Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_details_by_id as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_quantity }}</td>
                <td>{{ number_format($item->product_price) }}</td>
                <td>{{ number_format($item->product_quantity * $item->product_price) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection