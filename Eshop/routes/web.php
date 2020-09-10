<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search', 'HomeController@search');



Route::get('Route', ['as'=>'NewRoute', function () {
    echo "This is new route.";
}]);


//Home Show Product
Route::get('/category-product/{category_slug}','CategoryController@show_category_home');
Route::get('/brand-product/{brand_slug}','BrandController@show_brand_home');
Route::get('/show-details-product/{product_slug}','ProductController@show_details_product');


//Admin
Route::get('/dashboard', 'AdminController@Index');
Route::get('/admin', 'AdminController@getLogin');
Route::post('/admin-login', 'AdminController@postLogin');
Route::get('/admin-logout', 'AdminController@logout');

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::get('/all-user', 'AdminController@allUser');
    Route::get('/add-user', 'AdminController@addUser');
    Route::post('/save-user', 'AdminController@saveUser');

    Route::get('/edit-user/{user_id}', 'AdminController@editUser');
    Route::post('/update-user/{user_id}', 'AdminController@updateUser');

    Route::get('/delete-user/{user_id}', 'AdminController@deleteUser');
});


//Category
Route::get('/all-category', 'CategoryController@all_category')->middleware('admin');
Route::get('/add-category', 'CategoryController@add_category');
Route::get('/edit-category/{category_id}', 'CategoryController@edit_category');
Route::get('/delete-category/{category_id}', 'CategoryController@delete_category');

Route::post('/save-category', 'CategoryController@save_category');
Route::post('/update-category/{category_id}', 'CategoryController@update_category')->name('updateCat');

Route::get('/active-category/{category_id}', 'CategoryController@active_category');
Route::get('/deactive-category/{category_id}', 'CategoryController@deactive_category');

//Brand
Route::get('/all-brand', 'BrandController@all_brand')->middleware('admin');
Route::get('/add-brand', 'BrandController@add_brand');
Route::get('/edit-brand/{brand_id}', 'BrandController@edit_brand');
Route::get('/delete-brand/{brand_id}', 'BrandController@delete_brand');

Route::post('/save-brand', 'BrandController@save_brand');
Route::post('/update-brand/{brand_id}', 'BrandController@update_brand');

Route::get('/active-brand/{brand_id}', 'BrandController@active_brand');
Route::get('/deactive-brand/{brand_id}', 'BrandController@deactive_brand');

//Product
Route::get('/all-product', 'ProductController@all_product');
Route::get('/add-product', 'ProductController@add_product');
Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');

Route::get('/active-product/{product_id}', 'ProductController@active_product');
Route::get('/deactive-product/{product_id}', 'ProductController@deactive_product');


//Cart
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::post('/update-qty-cart', 'CartController@update_qty_cart');
Route::post('/update-cart', 'CartController@update_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');

Route::post('/add-cart-ajax', 'CartController@add_cart_ajax');
Route::get('/show-cart-ajax', 'CartController@show_cart_ajax');
Route::post('/update-qty-cart-ajax', 'CartController@update_qty_cart_ajax');
Route::get('/delete-cart-ajax/{session_id}', 'CartController@delete_cart_ajax');

//Checkout
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::get('/logout-checkout', 'CheckoutController@logout_customer')->name('login');

Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::get('/checkout', 'CheckoutController@checkout')->middleware('auth');
Route::post('/save-checkout', 'CheckoutController@save_checkout');
Route::get('/payment', 'CheckoutController@payment')->middleware('auth');

Route::post('/order', 'CheckoutController@order');

//Order
Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'CheckoutController@view_order');
Route::get('/delete-order/{orderId}', 'CheckoutController@delete_order');