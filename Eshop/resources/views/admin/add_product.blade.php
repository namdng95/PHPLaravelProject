@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Add New Product
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error')
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Name's Product</label>
                            <input type="text" name="product_name" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label >Slug</label>
                            <input type="text" name="product_slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Price</label>
                            <input type="text" name="product_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Image</label>
                            <input type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label >Description</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="CKeditor1"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Content</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="CKeditor2"></textarea>
                        </div>
                        <div class="form-group">
                            <label >Categories</label>
                            <select name="product_category" class="form-control input-sm m-bot15">
                                @foreach($categories as $key => $cate)
                                <option value="{{$cate->id}}">{{$cate->category_name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label >Brands</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach($brands as $key => $brand)
                                <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
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

                        <button type="submit" name="add_product" class="btn btn-info">Add Product</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection