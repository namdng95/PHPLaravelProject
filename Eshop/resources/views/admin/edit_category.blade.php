@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Edit Category
            </h1>
            @include('admin.form-error')
            <div class="panel-body">
                <div class="position-center">                   
                    @foreach($category_by_id as $key => $item)
                    <form role="form" action="{{URL::to('/update-category/'.$item->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label >Name's Category</label>
                            <input type="text" name="category_name" class="form-control" value="{{$item->category_name}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label >Slug</label>
                            <input type="text" name="category_slug" class="form-control" value="{{$item->category_slug}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label >Status</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                            @if($item->category_status == 0)
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            @else
                                <option value="0">Hide</option>
                                <option value="1" selected>Show</option>
                            @endif
                            </select>
                        </div>

                        <button type="submit" name="update_category" class="btn btn-info">Update Category</button>
                    </form>

                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection