<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Brands;
use App\Categories;
use App\User;
use App\Shipping;
use App\Orders;
use App\Order_Details;
use App\Payments;
use Cart;
use Session;
session_start();

class CheckoutController extends Controller
{

    public function order(Request $request)
    {
        //Payment
        $payment = new Payments();
        $payment->payment_method = $request->payment_option;
        $payment->payment_status = 'Đang chờ xử lý';
        $payment->save();

        //Order
        $order = new Orders();
        $order->customer_id = Auth::user()->id;
        $order->payment_id = $payment->id;
        $order->shipping_id = Session::get('shipping_id');
        $order->order_total = Cart::total();
        $order->order_status = 'Đang chờ xử lý';
        $order->save();

        //Order_Details
        $content = Cart::content();
        foreach($content as $data)
        {
            $order_details = new Order_Details();
            $order_details->order_id = $order->id;
            $order_details->product_id = $data->id;
            $order_details->product_name = $data->name;
            $order_details->product_price = $data->price;
            $order_details->product_quantity = $data->qty;
            $order_details->save();
        }
        
        switch ($payment->payment_method) {
            case 1:
                $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
                $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
                return  view('pages.handcash', compact('brands', 'categories'));
              break;
            case 2:
                $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
                $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
                return  view('pages.handcash', compact('brands', 'categories'));
              break;
            case 3:
                $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
                $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
                return  view('pages.handcash', compact('brands', 'categories'));
              break;
            default:
                $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
                $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
                return  view('pages.home', compact('brands', 'categories'));
          }

        
    }

    public function login_customer(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // $credentials = array(
        //     'email' => $email,
        //     'password' => $password
        // );
        
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return Redirect::to('/checkout');
        }else{
            Session::flash('error_login', 'Email hoặc mật khẩu không đúng!');
            return Redirect::to('/login-checkout');
        }
        
    }

    public function payment()
    {  
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        return  view('pages.payment', compact('brands', 'categories'));
    }

    public function save_checkout(Request $request)
    {
        $shipping = new Shipping();
        $shipping->user_id = $request->user_id;
        $shipping->shipping_email = $request->shipping_email;
        $shipping->shipping_name = $request->shipping_name;
        $shipping->shipping_address = $request->shipping_address;
        $shipping->shipping_phone = $request->shipping_phone;
        $shipping->shipping_desc = $request->shipping_desc;
        $shipping->save();

        Session::put('shipping_id', $shipping->id);

        return Redirect::to('/payment');
    }

    public function login_checkout()
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();

        return view('pages.login_checkout', compact('brands', 'categories'));
    }

    public function logout_customer()
    {
        Auth::logout();
        //Session::flush();
        //Session::forget('customer_id');
        return Redirect::to('/login-checkout');
    }

    public function add_customer(UserRequest $request)
    {
        $customer = new User();
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->save();


        if ($customer->exists) {
            Session::flash('success', 'Add Customer Successfully! Please login to checkout!');
        } else {
            Session::flash('error', 'Add Customer Error!');
        }

        return Redirect::to('/login-checkout');
    }

    public function checkout()
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        return view('pages.checkout', compact('brands', 'categories'));
    }


    public function manage_order()
    {
        $all_orders = Orders::query()->with('User')->orderby('created_at','asc')->get();
        return view('admin.manage_order', compact('all_orders'));
    }



    public function view_order($orderId)
    {
        $order_by_id = Orders::query()->with('Payment', 'Shipping', 'User')
        ->where('id', $orderId)->orderby('created_at','asc')->first();
        $order_details_by_id = Order_Details::query()->where('order_id', $orderId)->get();


        return view('admin.view_order', compact('order_by_id', 'order_details_by_id'));
    }

    public function delete_order($orderId)
    {
        Orders::where('id', $orderId)->delete();
        $is_exits = Orders::where('id', $orderId)->get();
        if (count($is_exits) > 0) {
            Session::flash('error', 'Delete Orders Error!');
        } else {
            Session::flash('success', 'Delete Orders Successfully!');
        }
        return Redirect::to('/manage-order');
    }



}