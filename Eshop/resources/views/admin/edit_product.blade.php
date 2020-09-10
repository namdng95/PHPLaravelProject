@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Edit Product
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error')
                    @foreach($product_by_id as $key => $item)
                    <form role="form" action="{{URL::to('/update-product/'.$item->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name's Product</label>
                            <input value="{{$item->product_name}}" type="text" name="product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Slug</label>
                            <input value="{{$item->product_slug}}" type="text" name="product_slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Price</label>
                            <input value="{{$item->product_price}}" type="text" name="product_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Image</label>
                            <input  type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Description</label>
                            <textarea value="{{$item->product_desc}}" style="resize: none" rows="8" class="form-control" name="product_desc" id="CKeditor1"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Content</label>
                            <textarea value="{{$item->product_content}}" style="resize: none" rows="8" class="form-control" name="product_content" id="CKeditor2"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Categories</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                            @foreach($categories as $key => $cate)
                                @if($cate->id == $item->category_id)
                                <option selected value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Brands</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                            @foreach($brands as $key => $brand)
                                @if($brand->id == $item->brand_id)
                                <option selected value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label >Status</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>

                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Update Product</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
    @endsection