@extends('layouts.admin')
@section('admin_content')

@include('block.notification')

<span style="padding: 15px 30px; background-color: lightgrey; border: none; margin: 5px 0; display: inline-block">
    <a href="{{URL::to('/add-category')}}" style="text-decoration: none; text-align: center; font-size: 20px; cursor: pointer; color: deepblue;">
    Add New Category
    </a>
</span>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name's Category</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_category as $key => $item)
            <tr>
                <td> {{ $item->id }} </td>
                <td> {{ $item->category_name }} </td>
                <td> {{ $item->category_slug }} </td>
                <td>
                @if($item->category_status == 1)
                    <a href="{{URL::to('/deactive-category/'.$item->id)}}">Hide</a>
                @else
                    <a href="{{URL::to('/active-category/'.$item->id)}}">Show</a>
                @endif
                </td>                   
                <td>
                    <a href="{{URL::to('/edit-category/'.$item->id)}}"><span>Edit</span></a> | 
                    <a href="{{URL::to('/delete-category/'.$item->id)}}"><span>Delete</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>

@endsection

