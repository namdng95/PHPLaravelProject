@extends('layouts.master')
@section('content')
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Features Items</h2>

        @foreach($product_by_brand as $item)

        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form action="">
                            @csrf
                            <input type="hidden" class="cart_product_id_{{$item->id}}" value="{{$item->id}}">
                            <input type="hidden" class="cart_product_name_{{$item->id}}" value="{{$item->product_name}}">
                            <input type="hidden" class="cart_product_price_{{$item->id}}" value="{{$item->product_price}}">
                            <input type="hidden" class="cart_product_image_{{$item->id}}" value="{{$item->product_image}}">
                            <input type="hidden" class="cart_product_qty_{{$item->id}}" value="1">
                            <a href="{{URL::to('/show-details-product/'.$item->product_slug)}}">
                                <img src="public/admin/galeryImages/{{$item->product_image}}" alt="" />
                                <h2>{{number_format($item->product_price)}} VND</h2>
                                <h4><b>{{$item->product_name}}</b></h4>
                                <p>{{$item->product_desc}}</p>
                            </a>
                            <button data-id="{{$item->id}}" type="button" class="btn btn-default add-to-cart"><i
                                    class="fa fa-shopping-cart"></i>
                                Add to cart
                            </button>
                        </form>
                    </div>
                    <!-- <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$item->product_price}}</h2>
                                            <p>{{$item->product_desc}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div> -->
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @endforeach

    </div>
    <!--features_items-->

</div>
@endsection