@extends('layouts.admin')
@section('admin_content')

@include('block.notification')

<span style="padding: 15px 30px; background-color: lightgrey; border: none; margin: 5px 0; display: inline-block">
    <a href="{{URL::to('/add-brand')}}" style="text-decoration: none; text-align: center; font-size: 20px; cursor: pointer; color: deepblue;">
    Add New Brand
    </a>
</span>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name's Brand</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($all_brand as $key => $item)
            <tr>
                <td> {{ $item->id }} </td>
                <td> {{ $item->brand_name }} </td>
                <td> {{ $item->brand_slug }} </td>
                <td>
                @if($item->brand_status == 1)
                    <a href="{{URL::to('/deactive-brand/'.$item->id)}}">Hide</a>
                @else
                    <a href="{{URL::to('/active-brand/'.$item->id)}}">Show</a>
                @endif
                </td>
                <td>
                    <a href="{{URL::to('/edit-brand/'.$item->id)}}"><span>Edit</span></a> | 
                    <a href="{{URL::to('/delete-brand/'.$item->id)}}"><span>Delete</span></a>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>

@endsection