@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Add New Brand
            </h1>

            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error')
                    <form role="form" action="{{URL::to('/save-brand')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name's Brand</label>
                            <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="brand_slug" class="form-control" id="exampleInputEmail1"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select name="brand_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>
                        </div>

                        <button type="submit" name="add_brand" class="btn btn-info">Add Brand</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection