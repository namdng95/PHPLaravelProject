@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Add New Category
            </h1>

            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error')
                    <form role="form" action="{{URL::to('/save-category')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name's Category</label>
                            <input type="text" name="category_name" class="form-control" id="exampleInputEmail1"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="category_slug" class="form-control" id="exampleInputEmail1"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status</label>
                            <select name="category_status" class="form-control input-sm m-bot15">
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category" class="btn btn-info">Add Category</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection