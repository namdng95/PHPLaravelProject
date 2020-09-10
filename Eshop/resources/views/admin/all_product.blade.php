@extends('layouts.admin')
@section('admin_content')

@include('block.notification')

<span style="padding: 15px 30px; background-color: lightgrey; border: none; margin: 5px 0; display: inline-block">
    <a href="{{URL::to('/add-product')}}"
        style="text-decoration: none; text-align: center; font-size: 20px; cursor: pointer; color: deepblue;">
        Add New Product
    </a>
</span>
    <table id="example" class="table table-striped table-bordered table-responsive" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Name's Product</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Slug</th>
                <th>Image</>
                <th>Description</th>
                <th>Content</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $item)
            <tr>
                <td> {{ $item->id }} </td>
                <td> {{ $item->product_name }} </td>
                <td> {{ $item->Brand->brand_name }} </td>
                <td> {{ $item->Category->category_name }} </td>
                <td> {{ $item->product_price }} </td>
                <td> {{ $item->product_slug }} </td>
                <td> <img style="width: 60%;" src="public/admin/galeryImages/{{ $item->product_image }}" alt=""> </td>
                <td> {{ $item->product_desc }} </td>
                <td> {{ $item->product_content }} </td>
                <td>
                    @if($item->product_status == 1)
                    <a href="{{URL::to('/deactive-product/'.$item->id)}}"><span
                            class="fa-thumb-styling fa fa-thumbs-up">Hide</span></a>
                    @else
                    <a href="{{URL::to('/active-product/'.$item->id)}}"><span
                            class="fa-thumb-styling fa fa-thumbs-up">Show</span></a>
                    @endif
                </td>
                <td>
                    <a href="{{URL::to('/edit-product/'.$item->id)}}"><span>Edit</span></a> |
                    <a href="{{URL::to('/delete-product/'.$item->id)}}"><span>Delete</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $all_product->links() }}

@endsection