@extends('layouts.master')
@section('content')
<div class="col-sm-9 padding-right">
    <section id="cart_items">
        <div class="container-fluid">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{URL::to('/home')}}">Home</a></li>
                    <li class="active">Check out</li>
                </ol>
            </div>
            <!--/breadcrums-->
            
            <div class="register-req">
                <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as
                    Guest</p>
            </div>
            <!--/register-req-->
            
            <div class="shopper-informations">
                <div class="row">
                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Bill To</p>
                            <div class="form-one">
                                <form action="{{URL::to('/save-checkout')}}" method="post">
                                {{ csrf_field() }}
                                    <input type="email" name="shipping_email" placeholder="Email">
                                    <input type="text" name="shipping_name" placeholder="Full Name">
                                    <input type="text" name="shipping_address" placeholder="Address">
                                    <input type="text" name="shipping_phone" placeholder="Phone Number">
                                    @if(isset(Auth::user()->id))
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" placeholder="Phone Number">
                                    @endif
                                    <textarea name="shipping_desc"
                                        placeholder="Notes about your order, Special Notes for Delivery"
                                        rows="16"></textarea>
                                    <input type="submit" name="send_order" class="btn btn-primary btn-sm" value="SEND">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear: both; margin: 0" class="payment-options">
                <button style="display: block; padding: 5px 10px;" class="btn btn-primary">
                    <a style="color: white; font-size: 18px" href="{{URL::to('/show-cart')}}">Back to order</a>
                </button>
            </div>
            <!--/back to order-->
            
        </div>
    </section>

</div>
<!--/#cart_items-->
@endsection