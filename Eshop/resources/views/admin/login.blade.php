<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{asset('public/admin/assets/admin.css')}}">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 center">
                <h1 class="text-center login-title">Sign in to continue to Admin Dashboard</h1>
                <div class="account-wall">
                    <form action="{{URL::to('/admin-login')}}" method="post" class="form-signin">
                        {{ csrf_field() }}
                        @include('block.error_login')
                        <input name="admin_email" type="text" class="form-control" placeholder="Email" value="<?php if(isset($admin_name)) echo $admin_name ?>">
                        @if ($errors->has('admin_email'))
                        <p class="text-danger">{{ $errors->first('admin_email') }}</p>
                        @endif
                        <input name="admin_password" type="password" class="form-control" placeholder="Password" value="<?php if(isset($admin_password)) echo $admin_password ?>">
                        @if ($errors->has('admin_password'))
                        <p class="text-danger">{{ $errors->first('admin_password') }}</p>
                        @endif
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in</button>
                        <label class="checkbox pull-left">
                            <input name="remember" type="checkbox" value="remember-me">
                            Remember me
                        </label>
                        <a href="#" class="pull-right need-help">Forgot Password? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="#" class="text-center new-account">Create an account </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>