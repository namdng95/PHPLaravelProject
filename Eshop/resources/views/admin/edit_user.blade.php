@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Edit User
            </h1>
            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error')
                    @foreach($user_by_id as $key => $item)
                    <form role="form" action="{{URL::to('admin/update-user/'.$item->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input value="{{$item->admin_name}}" type="text" name="admin_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input value="{{$item->password}}" type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input value="{{$item->admin_email}}" type="email" name="admin_email"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control input-sm m-bot15">
                                @if($item->role == 'Admin')
                                <option selected value="{{$item->role}}">{{$item->role}}</option>
                                <option  value="Manager">Manager</option>
                                <option  value="Staff">Staff</option>
                                @elseif($item->role == 'Manager')
                                <option selected value="{{$item->role}}">{{$item->role}}</option>
                                <option  value="Admin">Admin</option>
                                <option  value="Staff">Staff</option>
                                @elseif($item->role == 'Staff')
                                <option selected value="{{$item->role}}">{{$item->role}}</option>
                                <option  value="Admin">Admin</option>
                                <option  value="Manager">Manager</option>                              
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control input-sm m-bot15">
                                @if($item->status == 'Actived')
                                <option selected value="{{$item->status}}">{{$item->status}}</option>
                                <option selected value="Not Active">Not Active</option>
                                @else
                                <option selected value="{{$item->status}}">{{$item->status}}</option>
                                <option selected value="Actived">Actived</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="add_user" class="btn btn-info">Update User</button>
                    </form>
                    @endforeach
                </div>

            </div>
        </section>

    </div>
    @endsection