<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Admin;
use Session;
use Cookie;
session_start();

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }
    

    public function allUser()
    {
        $all_user = Admin::paginate(2);
        return view('admin.all_user', compact('all_user'));
    }

    public function addUser()
    {
        return view('admin.add_user');
    }
    public function saveUser(UsersRequest $request)
    {
        $user = new Admin();
        $user->admin_email = $request->admin_email;
        $user->password = Hash::make($request->password);
        $user->admin_name = $request->admin_name;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();


        if ($user->exists) {
            Session::flash('success', 'Add User Successfully!');
        } else {
            Session::flash('error', 'Add User Error!');
        }

        return Redirect::to('admin/all-user');
    }

    public function editUser($user_id)
    {
        $user_by_id = Admin::where('id', $user_id)->get();
        return view('admin.edit_user', compact('user_by_id'));
    }

    public function updateUser(AdminRequest $request, $user_id)
    {
        $user = Admin::find($user_id);
        $user->admin_email = $request->admin_email;
        $user->password = Hash::make($request->password);
        $user->admin_name = $request->admin_name;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        if($user->wasChanged())
        {
            Session::flash('success', "Update Brand Successfully!");
        }
        else
        {
            Session::flash('error', "Update Brand Error!");
        }
        return Redirect::to('admin/all-user');
    }

    public function deleteUser($user_id)
    {
        Admin::where('id', $user_id)->delete();
        $is_exits = Admin::where('id', $user_id)->get();
        if (count($is_exits) > 0) {
            Session::flash('error', 'Delete Brand Error!');
        } else {
            Session::flash('success', 'Delete Brand Successfully!');
        }
        return Redirect::to('admin/all-user');
    }

    public function Index()
    {
        return view('admin.dashboard');
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return view('admin.login');
    }


    public function getLogin()
    {   
        $admin_name = Cookie::get('admin_name');
        $admin_password = Cookie::get('admin_password');
        return view('admin.login', compact('admin_name', 'admin_password'));
    }
    public function postLogin(AdminRequest $request)
    {        
        $credentials = array(
            'admin_email' => $request->admin_email,
            'password' => $request->admin_password
        );
        //$credentials= ['admin_email' => $request->get('admin_email'), 'password'=>$request->get('admin_password')]; 
        //$credentials = $request->only('admin_email', 'password');
        //$remember = ($request->has('remember')) ? true : false;
        //$email = $request->admin_email;       
        // $password = $request->admin_password;
        if($request->has('remember')) {
            $response = new Response('Set Cookie');
            $response->withCookie(cookie('admin_name', $request->admin_email, 60));
            $response->withCookie(cookie('admin_password', $request->admin_password, 60));           
            $remember = true;
        } else {
            $remember = false;
        }

        if(Auth::guard('admin')->attempt($credentials)) {   
            $admin_name = Admin::where('admin_email', $request->admin_email)->first();
            Session::put('admin_name', $admin_name->admin_name);
            return view('admin.dashboard');
        } else {
            Session::flash('error_login', 'Email or Password is incorrect!');
            return Redirect::to('/admin');
        }
    }
}