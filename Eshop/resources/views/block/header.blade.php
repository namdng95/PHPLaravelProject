<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('public/asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/asset/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('public/asset/js/html5shiv.js')}}"></script>
    <script src="{{asset('public/asset/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{asset('public/asset/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{asset('public/asset/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{asset('public/asset/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{asset('public/asset/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
        href="{{asset('public/asset/images/ico/apple-touch-icon-57-precomposed.png')}}">

    <!-- Sweet alert CSS -->
    <link href="{{asset('public/asset/css/sweetalert.css')}}" rel="stylesheet">
    <!-- Sweet alert JS -->
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="{{asset('public/asset/js/sweetalert.js')}}"></script>
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 clearfix">
                        <div class="logo pull-left">
                            <a href="{{asset('public/asset/index.html')}}"><img
                                    src="{{asset('public/asset/images/home/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right clearfix">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    USA
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canada</a></li>
                                    <li><a href="#">UK</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                    data-toggle="dropdown">
                                    DOLLAR
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Canadian Dollar</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 clearfix">
                        <div class="shop-menu clearfix pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                <?php 
                                    $shipping_id = Session::get('shipping_id');
                                
                                if(Auth::check() && $shipping_id != null){ ?>
                                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php }
                                 else if(Auth::check() && $shipping_id == null){ ?>
                                <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a>
                                </li>
                                <?php }
                                else { ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i>
                                        Checkout</a></li>
                                <?php } ?>

                                    

                                <?php
                                
                                if(Session::get('cart')) {

                                    $totalQty = 0;
                              
                                    foreach(Session::get('cart') as $itemQty){
                                        $totalQty += $itemQty['product_qty'];
                                    }
                              
                                }
                              
                                //echo $totalquantity;

                                ?>   

                                <li><a href="{{URL::to('/show-cart-ajax')}}"><i class="fa fa-shopping-cart"></i>
                                        Cart(<?php if(isset($totalQty)) echo $totalQty; ?>)</a></li>
                                <!-- <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i>
                                        Cart({{ Cart::count() }})</a></li> -->
                                @if(Auth::check())
                                <!-- Auth::check -->
                                <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                @else
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/home')}}" class="active">Home</a></li>
                                <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Products</a></li>
                                        <li><a href="#">Product Details</a></li>
                                        <li><a href="{{URL::to('/checkout')}}">Checkout</a></li>
                                        <li><a href="#">Cart</a></li>
                                        <li><a href="{{URL::to('/login-checkout')}}">Login</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Blog List</a></li>
                                        <li><a href="#">Blog Single</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">404</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/search')}}" method="post">
                        {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="search_product" placeholder="Search" />
                                <input type="submit" name="search_items" value="Search" class="btn btn-primary btn-sm" style="color: white; margin-top: 0; width: 100px">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->