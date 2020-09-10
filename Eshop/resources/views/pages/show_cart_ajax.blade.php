@extends('layouts.master')
@section('content')

<div class="col-sm-9 padding-right">
    <div class="features_items">
        <section id="cart_items">
            <div class="container-fluid">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Shopping Cart</li>
                    </ol>
                </div>


                @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
                @elseif(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                @endif



                <div class="table-responsive cart_info">


                    <form action="{{URL::to('/update-qty-cart-ajax')}}" method="POST">
                        @csrf
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
                            @if(Session::get('cart') == true)
                            <?php $total = 0; ?>
                            @foreach(Session::get('cart') as $key => $cart)
                            <?php 
                            

                            $subTotal = $cart['product_price'] * $cart['product_qty'];
                            $total += $subTotal;
 
                        ?>

                            <tbody>
                                <tr>
                                    <td class="image">
                                        <a href=""><img style="width: 40%"
                                                src="{{asset('public/admin/galeryImages/'.$cart['product_image'])}}"
                                                alt=""></a>
                                    </td>
                                    <td class="name">
                                        <h4>{{$cart['product_name']}}</h4>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{number_format($cart['product_price'],0,",",".") . ' ' . 'VND'}}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <input type="number" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{number_format($subTotal,0,",",".") . ' ' . 'VND'}}
                                        </p>
                                    </td>
                                    <td style="margin-top: 65px" class="cart_delete">
                                        <a class="cart_quantity_delete"
                                            href="{{URL::to('/delete-cart-ajax/'.$cart['session_id'])}}"><i
                                                class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                            @endforeach
                            <tr>
                                <td>
                                    <input type="submit" value="Update Cart" name="update_qty"
                                        class="check_out btn btn-default btn-sm">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </section>
        <!--/#cart_items-->

        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Total <span>{{number_format($total,0,",",".") . ' ' . 'VND'}}</span></li>
                                <li>Eco Tax <span></span></li>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span>{{number_format($total,0,",",".") . ' ' . 'VND'}}</span></li>
                            </ul>
                            <!-- <a class="btn btn-default update" href="">Update</a> -->
                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @else
        <tbody>
            <tr>
                <td colspan="6">
                    <center>
                        Please add product to cart
                    </center>
                </td>
            </tr>
        </tbody>
        </table>
        @endif
        <!--/#do_action-->
        <div style="clear: both; margin: 5px 0" class="payment-options">
            <button style="margin-top: 10%; display: block; padding: 10px 15px;" class="btn btn-primary">
                <a style="color: white; font-size: 18px" href="{{URL::to('/home')}}">Back to shopping</a>
            </button>
        </div>
    </div>
</div>

@endsection