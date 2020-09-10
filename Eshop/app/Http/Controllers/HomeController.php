<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Products;
use App\Categories;
use App\Brands;
use Session;
session_start();

class HomeController extends Controller
{
    //
    function index(){
        $all_product = Products::where('product_status', '1' )->orderby('id', 'desc')->get();
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();
        return view('pages.home', compact('all_product', 'brands', 'categories'));
    }


    public function search(Request $request)
    {
        $searchInput = $request->search_product;
        $brands = Brands::where('brand_status', '1' )->orderby('id', 'desc')->get();
        $categories = Categories::where('category_status', '1' )->orderby('id', 'desc')->get();

        if(!empty($searchInput))
        {
            $listSearch = Products::query()
            ->where([
                ['product_status', 1], ['product_name', 'LIKE', '%'.$searchInput.'%']
            ])
            ->whereHas('Category', function($query) use ( $searchInput){
                $query->where('category_status', 1);
            })
            ->whereHas('Brand', function($query) use ( $searchInput){
                $query->where('brand_status', 1);
            })->get();

            return view('pages.search', compact('listSearch', 'brands', 'categories'));
        }
        
        Session::flash('error', 'No results were found!');
        return view('pages.form_error', compact('brands', 'categories'));
    }



    // function GetURL(Request $request){
    //     // echo $request->path() . '</br>';
    //     // echo $request->url();
    //     if($request->isMethod('get'))
    //         echo "Method Get";
    //     else
    //         echo "Method Post";
    // }
    // function postForm(Request $request){
    //     echo $request->input('HoTen');
    //     echo $request->HoTen;
    // }
    // function postFile(Request $request){
    //     if($request->hasFile('myFile')){
    //         $file = $request->myFile;
    //         if($file->getClientOriginalExtension('myFile') == "jpg"){
    //             $file->move(
    //                 'public/img',
    //                 $file->getClientOriginalName()
    //             );
    //             echo "Upload Success!";
    //         }else{
    //             echo "Error file format!";
    //         }
            
    //     }else{
    //         echo "File not found!";
    //     }
    // }


    // public function setCookie(Request $request){
    //     $minutes = 0.1; // = 6s
    //     $response = new Response();
    //     $response->withCookie(cookie('username', 'Username', $minutes));
    //     return $response;
    // }

    // public function getCookie(Request $request){
    //     return $request->cookie('username');
    // }


    // public function getJson(){
    //     $array = ['name' => 'Nguyen Trung Nam', 'age' => '18 years old', 'city' => 'Da Nang'];
    //     return response()->json($array);
    // }

    // public function viewDemo(){
    //     $string = "<b>Nguyen Trung Nam</b>";
    //     return view('TestLayout', ['name' => $string,  'check' => true]);
    // } 

}
