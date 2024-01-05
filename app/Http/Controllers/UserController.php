<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // Remove the following line, as Laravel manages sessions internally
        // @session_start();
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //Kiểm tra xem có trống không
        if (empty($username) || empty($password)) {
            return redirect('admin/login')->with('notice', 'Tài khoản hoặc mật khẩu không được để trống');
        }

        //Kiểm tra xem có đúng không
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect('/admin/home');
        } else {
            return redirect('admin/login')->with('notice', 'Tài khoản hoặc mật khẩu chưa chính xác, vui lòng thử lại');
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
