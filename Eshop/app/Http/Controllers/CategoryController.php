<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Brands;
use App\Products;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CategoryController extends Controller
{
    public function show_category_home($category_slug)
    {
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        
        $product_by_cate = Products::whereHas('Category', function($query) use ($category_slug){
            $query->where([['category_status', 1], ['category_slug', $category_slug]]);
        })->where('product_status', 1)->get();
        

        return view('pages.show_category', compact('brands', 'categories', 'product_by_cate'));
    }
    public function all_category()
    {
        $all_category = Categories::all();
        return view('admin.all_category', compact('all_category'));
        // return view('admin.all_category')->with(compact('all_category'));
    }
    public function add_category()
    {
        return view('admin.add_category');
    }
    public function save_category(CategoryRequest $request)
    {
        //$data = $request->all();
        $category = Categories::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'category_status' => $request->category_status
        ]);
        if ($category->exists) {
            Session::flash('success', 'Add Category Successfully!');
        } else {
            Session::flash('error', 'Add Category Error!');
        }

        return Redirect::to('all-category');
    }



    public function delete_category($category_id)
    {
        Categories::where('id', $category_id)->delete();
        $is_exits = Categories::where('id', $category_id)->get();
        if (count($is_exits) > 0) {
            Session::flash('error', 'Delete Category Error!');
        } else {
            Session::flash('success', 'Delete Category Successfully!');
        }
        return Redirect::to('/all-category');
    }


    public function active_category($category_id)
    {
        //$category = Categories::where('id', $category_id)->update(['category_status' => 1]);
        $category = Categories::find($category_id);
        $category->category_status = 1;
        $category->save();
        if($category->wasChanged())
        {
            Session::flash('success', "Active Category Successfully!");
        }
        else
        {
            Session::flash('error', "Active Category Error!");
        }
        return Redirect::to('/all-category');
    }
    public function deactive_category($category_id)
    {
        $category = Categories::find($category_id);
        $category->category_status = 0;
        $category->save();
        if($category->wasChanged())
        {
            Session::flash('success', "Deactive Category Successfully!");
        }
        else
        {
            Session::flash('error', "Deactive Category Error!");
        }
        return Redirect::to('/all-category');
    }




    public function edit_category($category_id)
    {
        $category_by_id = Categories::where('id', $category_id)->get();
        return view('admin.edit_category', compact('category_by_id'));
    }

    public function update_category(CategoryRequest $request, $category_id)
    {
        $category = Categories::find($category_id);
        $category->category_name = $request->category_name;
        $category->category_slug = $request->category_slug;
        $category->category_status = $request->category_status;
        $category->save();

        if($category->wasChanged())
        {
            Session::flash('success', "Update Category Successfully!");
        }
        else
        {
            Session::flash('error', "Update Category Error!");
        }
        return Redirect::to('/all-category');
    }

}