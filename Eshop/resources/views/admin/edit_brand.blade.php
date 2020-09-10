@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Edit Brand
            </h1>
            @include('admin.form-error')
            <div class="panel-body">
                <div class="position-center">            
                    @foreach($brand_by_id as $key => $item)
                    <form role="form" action="{{URL::to('/update-brand/'.$item->id)}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label >Name's Brand</label>
                            <input type="text" name="brand_name" class="form-control" value="{{$item->brand_name}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label >Slug</label>
                            <input type="text" name="brand_slug" class="form-control" value="{{$item->brand_slug}}" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label >Status</label>
                            <select name="brand_status" class="form-control input-sm m-bot15">
                            @if($item->brand_status == 0)
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            @else
                                <option value="0">Hide</option>
                                <option value="1" selected>Show</option>
                            @endif
                            </select>
                        </div>

                        <button type="submit" name="update_brand" class="btn btn-info">Update Brand</button>
                    </form>

                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
@endsection