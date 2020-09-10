<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Cart;
use Session;
use App\Products;
use App\Categories;
use App\Brands;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = Products::where('id', $productId)->first();
        //Cart attributes
        $data['id'] = $product_info->id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '0';
        $data['options']['image'] = $product_info->product_image;   
        //$data['options']['desc'] = 'This is DESCRIPTION';
        Cart::add($data);

        return Redirect::to('/show-cart');
    }

    public function show_cart()
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        return view('pages.show_cart', compact('brands', 'categories'));
    }
    public function update_qty_cart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }

    public function delete_cart($rowId)
    {
        Cart::remove($rowId);
        return Redirect::to('/show_cart');
    }


    //----------------Cart ajax------------------

    public function show_cart_ajax()
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        return view('pages.show_cart_ajax', compact('brands', 'categories'));
    }

    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5); //substr(string, start, Length)
        $cart = Session::get('cart');
        if($cart == true){
            $is_avaiable = 0; //check avaiable ID product in cart
            foreach($cart as $key => $value){
                if($value['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                    // important
                    $cart[$key]['product_qty'] += 1;
                }
            }
            Session::put('cart', $cart); //<--------save session after change qty
            if($is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id, //rowId
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_price' => $data['cart_product_price'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                );
                Session::put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id, //rowId
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
            );
            Session::put('cart', $cart);
        }  
        Session::save();
    }
    public function update_qty_cart_ajax(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart){
            //$data['cart_qty'] get in input $key = name="cart_qty[{{$cart['session_id']}}]" & value="{{$cart['product_qty']}}"
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $value){
                    if($value['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            Session::flash('success', 'Update Success!');
            return Redirect::to('/show-cart-ajax');
        }else{
            Session::flash('error', 'Update Error!');
            return Redirect::to('/show-cart-ajax');
        }
    }

    public function delete_cart_ajax($session_id)
    {
        $cart = Session::get('cart');
        if($cart){
            foreach($cart as $key => $value){
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            Session::flash('success', 'Delete Success!');
            return Redirect::to('/show-cart-ajax');
        }else{
            Session::flash('error', 'Delete Error!');
            return Redirect::to('/show-cart-ajax');
        }
    }

}
