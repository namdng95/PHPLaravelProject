@extends('layouts.admin')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <h1 class="panel-heading">
                Add New User
            </h1>
            
            <div class="panel-body">
                <div class="position-center">
                    @include('admin.form-error') <!-- Form Validate -->
                    @include('block.notification') <!-- Form Notification Session -->
                    <form role="form" action="{{URL::to('admin/save-user')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="admin_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="admin_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="admin_email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control input-sm m-bot15">
                                <option value="Admin">Admin</option>
                                <option value="Manager">Manager</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control input-sm m-bot15">
                                <option value="Not Active">Not Active</option>
                                <option value="Active">Active</option>
                            </select>
                        </div>

                        <button type="submit" name="add_user" class="btn btn-info">Save User</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection