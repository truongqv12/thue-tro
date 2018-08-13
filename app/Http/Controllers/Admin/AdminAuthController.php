<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AdminAuthController extends Controller
{
    public function  getAdminLogin(){
        if (Auth::check()){
            return redirect()->route('admin');
        }
        else {
            return view('admin.layout.login');
        }
    }

    public function postAdminLogin(Request $rq){
        $this->validate($rq,
            [
                'login_name' => 'required',
                'password'  => 'required | min:3 | max:40'
            ],[
                'login_name.required' => 'Tên đăng nhập không được để trống',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu không được nhỏ hơn 3 ký tự',
                'password.max' => 'Mật khẩu không được lớn hơn 40 ký tự'
            ]
        );

        if(Auth::attempt(['adm_login_name' => $rq->login_name, 'password' => $rq->password])){
            return redirect()->route('admin');
        }
        else{
            return redirect()->route('login_admin')->with('thongbao','Tài khoản hoặc mật khẩu không đúng');
        }

    }

    public function getAdminLogout(){
        Auth::logout();
        return redirect()->route('login_admin');
    }
}
