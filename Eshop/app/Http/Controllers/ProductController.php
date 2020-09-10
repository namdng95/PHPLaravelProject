<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Products;
use App\Brands;
use App\Categories;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function show_details_product($product_slug)
    {
        $brands = Brands::all();
        $categories = Categories::all();

        $details_product = Products::query()->where([['product_status', 1], ['product_slug', $product_slug]
        ])->whereHas('Category', function($query){
            $query->where('category_status', 1);
        })->whereHas('Brand', function($query){
            $query->where('brand_status', 1);
        })->get();

        return view('pages.show_details_product', compact('brands', 'categories', 'details_product'));
    }
    public function all_product()
    {
        $all_product = Products::query()->with('Category', 'Brand')->paginate(3);
        return view('admin.all_product', compact('all_product'));
    }

    public function add_product()
    {
        $brands = Brands::all();
        $categories = Categories::all();
        return view('admin.add_product', compact('brands', 'categories'));

    }

    public function save_product(ProductRequest $request)
    {
        //$data = $request->all();
        $image_name = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin/galeryImages/');
            $image->move($destinationPath, $image_name);

            $product = Products::create([
                'product_name' => $request->product_name,
                'product_slug' => $request->product_slug,
                'product_price' => $request->product_price,
                'product_image' => $image_name,
                'product_desc' => strip_tags($request->product_desc),
                'product_content' => strip_tags($request->product_content),
                'category_id' => $request->product_category,
                'brand_id' => $request->product_brand,
                'product_status' => $request->product_status
            ]);
            if ($product->exists) {
                Session::flash('success', 'Add Product Successfully!');
            } else {
                Session::flash('error', 'Add Product Error!');
            }

            return Redirect::to('all-product');
        }

        Session::flash('error', 'Image Upload Error!');

        return Redirect::to('all-product');
    }



    public function delete_product($product_id)
    {
        Products::where('id', $product_id)->delete();
        $is_exits = Products::where('id', $product_id)->get();
        if (count($is_exits) > 0) {
            Session::flash('error', 'Delete Product Error!');
        } else {
            Session::flash('success', 'Delete Product Successfully!');
        }
        return Redirect::to('/all-product');
    }


    public function active_product($product_id)
    {
        //$product = Products::where('id', $product_id)->update(['product_status' => 1]);
        $product = Products::find($product_id);
        $product->product_status = 1;
        $product->save();
        if($product->wasChanged())
        {
            Session::flash('success', "Active Product Successfully!");
        }
        else
        {
            Session::flash('error', "Active Product Error!");
        }
        return Redirect::to('/all-product');
    }
    public function deactive_product($product_id)
    {
        $product = Products::find($product_id);
        $product->product_status = 0;
        $product->save();
        if($product->wasChanged())
        {
            Session::flash('success', "Deactive Product Successfully!");
        }
        else
        {
            Session::flash('error', "Deactive Product Error!");
        }
        return Redirect::to('/all-product');
    }


    public function edit_product($product_id)
    {
        $brands = Brands::all();
        $categories = Categories::all();
        $product_by_id = Products::where('id', $product_id)->get();
        return view('admin.edit_product', compact('product_by_id', 'brands', 'categories'));
    }

    public function update_product(ProductRequest $request, $product_id)
    {
        $image_name = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/admin/galeryImages/');
            $image->move($destinationPath, $image_name);

            $product = Products::find($product_id);
            $product->product_name = $request->product_name;
            $product->product_slug = $request->product_slug;
            $product->product_price = $request->product_price;
            $product->product_image = $image_name;
            $product->product_desc = strip_tags($request->product_desc);
            $product->product_content = strip_tags($request->product_content);
            $product->category_id = $request->product_cate;
            $product->brand_id = $request->product_brand;
            $product->product_status = $request->product_status;
            $product->save();
                
            if($product->wasChanged())
            {
                Session::flash('success', "Update Product Successfully!");
            }
            else
            {
                Session::flash('error', "Update Product Error!");
            }
            return Redirect::to('/all-product');
        }

        Session::flash('error', "Please Choose Image Product!");
        
        return Redirect::to('all-product');





        

        
    }

}
