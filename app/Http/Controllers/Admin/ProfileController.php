<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    public function index() {
        return view('admin.profile.profile');
    }

    public function edit(Request $rq){
        $admin = Admin::findOrFail(Auth::user()->adm_id);
        $this->validate($rq,
            [
                'adm_name' => 'required',
                'adm_password_old' => 'required',
                'adm_password' => 'required|min:4|confirmed',
                'adm_email' => 'required|email',
                'adm_phone'  => 'min:4| max:15',
                'adm_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'adm_name.required' => 'Họ tên không được để trống',
                'adm_email.required' => 'Email không được để trống',
                'adm_email.email' => 'Email không đúng',
                'adm_password_old.required' => 'Bạn chưa nhập nhập mật khẩu cũ',
                'adm_password.required' => 'Bạn chưa nhập mật khẩu mới',
                'adm_password.confirmed' => 'Mật khẩu mới không khớp',
                'adm_password.min' => 'Mật khẩu quá ngắn',
                'adm_phone.min' => 'Số điện thoại không đúng',
                'adm_phone.max' => 'Số điện thoại không đúng',
                'adm_avatar.image' => 'File phải là ảnh',
                'adm_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );

        $img_name = $admin->adm_avatar;
        $current_password = $rq->adm_password_old;
        $new_password = $rq->adm_password;

        $rq->offsetunset('_token');

        if (Hash::check($current_password, $admin->adm_password)){

            if($rq->hasFile('adm_avatar')){
                Storage::disk('user')->delete($admin->adm_avatar);
                $image = $rq->adm_avatar;
                $img_name = date('y-m-d').'_'.$rq->adm_login_name.'_avatar.'.$image->getClientOriginalExtension();
                $resize = Image::make($image);
                $resize->resize(200,200)->encode('jpg');
                Storage::disk('user')->put($img_name,$resize->__toString());
            }
            $rq->merge([
                'adm_avatar' => $img_name,
                'adm_password' => bcrypt($new_password)
            ]);
            $admin->adm_name = $rq->adm_name;
            $admin->adm_email = $rq->adm_email;
            $admin->adm_password = $rq->adm_password;
            $admin->adm_phone = $rq->adm_phone;
            $admin->adm_avatar = $img_name;
            $check = $admin->save();
            if ($check){
                return redirect()->route('admin_profile')->with('success','Sửa tài khoản thành công');
            }
            else{
                return redirect()->route('admin_profile')->with('error','Sửa tài khoản thất bại, vui lòng thử lại');
            }
        }
        else{
            return redirect()->back()->with('error','Mật khẩu cũ không đúng');
        }
    }
}
