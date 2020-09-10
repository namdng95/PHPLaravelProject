@extends('layouts.master')
@section('content')
<div class="col-sm-9 padding-right">
    <section id="cart_items">
        <div class="container-fluid">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <span style="display: inline-block; margin-bottom: 10px">
                <a href="{{URL::to('/show-cart')}}" style="color: black; font-weight: bold; font-size: 25px;">Back to
                    order</a>
            </span>
            <div class="table-responsive cart_info">

                <?php 
                //Get data from cart
                $content = Cart::content();
                ?>

                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td style="width: 25%" class="image">Image</td>
                            <td class="description">Name</td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td>Delete</td>
                        </tr>
                    </thead>
                    @foreach($content as $data)
                    <tbody>
                        <tr>
                            <td class="image">
                                <a href=""><img style="width: 40%"
                                        src="{{asset('public/admin/galeryImages/'.$data->options->image)}}" alt=""></a>
                            </td>
                            <td class="description">
                                <h4>{{$data->name}}</h4>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($data->price).'VND'}}</p>
                            </td>
                            <td class="cart_quantity">
                                <form action="{{URL::to('/update-qty-cart')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="cart_quantity_button">
                                        <input type="hidden" name="rowId" value="{{$data->rowId}}">
                                        <input type="number" name="quantity" value="{{$data->qty}}" size="1">
                                        <input type="submit" value="Update">
                                    </div>
                                </form>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?php 
                                    $total = $data->price * $data->qty;
                                    echo number_format($total).' '.'VND';
                                ?>
                                </p>
                            </td>
                            <td style="margin-top: 65px" class="cart_delete">
                                <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$data->rowId)}}"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </section>
    <!--/#cart_items-->
    <h4>Choose the form of payment</h4>
    <form action="{{URL::to('/order')}}" method="post">
    {{ csrf_field() }}
        <div style="clear: both; margin: 20px 0 0 0;" class="payment-options">
            <span>
                <label><input name="payment_option" type="checkbox" value="1"> Direct Bank Transfer </label>
            </span>
            <span>
                <label><input name="payment_option" type="checkbox" value="2"> Pay by Cash </label>
            </span>
            <span>
                <label><input name="payment_option" type="checkbox" value="3"> Pay by Debit Card </label>
            </span>
            <span>
                <input type="submit" value="Order" class="btn btn-primary" name="send-order"
                    style="clear: both; margin: 0 0 0 0; padding: 10px 25px">
            </span>
        </div>
    </form>

</div>
@endsection