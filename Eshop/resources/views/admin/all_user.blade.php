@extends('layouts.admin')
@section('admin_content')

@include('block.notification')

<span style="padding: 15px 30px; background-color: lightgrey; border: none; margin: 5px 0; display: inline-block">
    <a href="{{URL::to('admin/add-user')}}"
        style="text-decoration: none; text-align: center; font-size: 20px; cursor: pointer; color: deepblue;">
        Add New User
    </a>
</span>
<table id="example" class="table table-striped table-bordered table-responsive">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_user as $key => $item)
        <tr>
            <td> {{ $item->id }} </td>
            <td> {{ $item->admin_name }} </td>
            <td> {{ $item->admin_email }} </td>
            <td> {{ $item->password }} </td>
            <td> {{ $item->role }} </td>
            <td>
                @if($item->status == 'Actived')
                <span>{{ $item->status }}</span><br>
                <a href="{{URL::to('/deactive-user/'.$item->id)}}"><span>Deactive</span></a>
                @else
                <span>{{ $item->status }}</span><br>
                <a href="{{URL::to('/active-user/'.$item->id)}}"><span>Active</span></a>
                @endif
            </td>
            <td>
                <a  href="{{URL::to('admin/edit-user/'.$item->id)}}"><span>Edit</span></a> |
                <a onclick="return confirm('Are you sure you want to delete this User?')" href="{{URL::to('admin/delete-user/'.$item->id)}}"><span>Delete</span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $all_user->links() }}

@endsection