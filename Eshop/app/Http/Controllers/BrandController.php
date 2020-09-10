<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Brands;
use App\Categories;
use App\Products;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class BrandController extends Controller
{

    public function show_brand_home($brand_slug)
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        
        $product_by_brand = Products::whereHas('Brand', function($query) use ($brand_slug){
            $query->where([['brand_status', 1], ['brand_slug', $brand_slug]]);
        })->where('product_status', 1)->get();
        
        return view('pages.show_brand', compact('brands', 'categories', 'product_by_brand'));
    }

    public function add_brand()
    {
        return view('admin.add_brand');
    }
    public function all_brand()
    {
        $all_brand = Brands::all();
        return view('admin.all_brand', compact('all_brand'));
    }



    public function save_brand(BrandRequest $request)
    {
        //$data = $request->all();
        $brand = Brands::create([
            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
            'brand_status' => $request->brand_status
        ]);
        if ($brand->exists) {
            Session::flash('success', 'Add Brand Successfully!');
        } else {
            Session::flash('error', 'Add Brand Error!');
        }

        return Redirect::to('all-brand');
    }



    public function delete_brand($brand_id)
    {
        Brands::where('id', $brand_id)->delete();
        $is_exits = Brands::where('id', $brand_id)->get();
        if (count($is_exits) > 0) {
            Session::flash('error', 'Delete Brand Error!');
        } else {
            Session::flash('success', 'Delete Brand Successfully!');
        }
        return Redirect::to('/all-brand');
    }


    public function active_brand($brand_id)
    {
        //$brand = Brands::where('id', $brand_id)->update(['brand_status' => 1]);
        $brand = Brands::find($brand_id);
        $brand->brand_status = 1;
        $brand->save();
        if($brand->wasChanged())
        {
            Session::flash('success', "Active Brand Successfully!");
        }
        else
        {
            Session::flash('error', "Active Brand Error!");
        }
        return Redirect::to('/all-brand');
    }
    public function deactive_brand($brand_id)
    {
        $brand = Brands::find($brand_id);
        $brand->brand_status = 0;
        $brand->save();
        if($brand->wasChanged())
        {
            Session::flash('success', "Deactive Brand Successfully!");
        }
        else
        {
            Session::flash('error', "Deactive Brand Error!");
        }
        return Redirect::to('/all-brand');
    }




    public function edit_brand($brand_id)
    {
        $brand_by_id = Brands::where('id', $brand_id)->get();
        return view('admin.edit_brand', compact('brand_by_id'));
    }

    public function update_brand(BrandRequest $request, $brand_id)
    {
        $brand = Brands::find($brand_id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $request->brand_slug;
        $brand->brand_status = $request->brand_status;
        $brand->save();

        if($brand->wasChanged())
        {
            Session::flash('success', "Update Brand Successfully!");
        }
        else
        {
            Session::flash('error', "Update Brand Error!");
        }
        return Redirect::to('/all-brand');
    }
}
