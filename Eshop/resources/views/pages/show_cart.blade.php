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
                <div class="table-responsive cart_info">

                <?php 
                //Get data from cart
                $content = Cart::content();
                // echo '<pre>';
                // dd($content);
                // echo '</pre>';
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
                                            src="{{asset('public/admin/galeryImages/'.$data->options->image)}}"
                                            alt=""></a>
                                </td>
                                <td class="description">
                                    <h4>{{$data->name}}</h4>
                                </td>
                                <td class="cart_price">
                                    <p>{{number_format($data->price) . ' ' . 'VND'}}</p>
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

        <section id="do_action">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="total_area">
                            <ul>
                                <li>Total <span>{{ Cart::total().' '.'VND' }}</span></li>
                                <li>Eco Tax <span>{{ Cart::tax() }}</span></li>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span>{{ Cart::total().' '.'VND' }}</span></li>
                            </ul>
                            <!-- <a class="btn btn-default update" href="">Update</a> -->
                            <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/#do_action-->
        <div style="clear: both; margin: 5px 0" class="payment-options">
            <button style="display: block; padding: 10px 15px;" class="btn btn-primary">
                <a style="color: white; font-size: 18px" href="{{URL::to('/home')}}">Back to shopping</a>
            </button>
        </div>
    </div>
</div>

@endsection