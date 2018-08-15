<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::all();
        $columns = [
            'Họ tên', 'Tài khoản', 'Email', 'Image', 'SĐT', 'Trạng thái', 'Quyền', 'Hành động'
        ];

        return view('admin.admin.index',[
            'admins' => $admins,
            'columns' => $columns,
        ]);
    }

    public function add() {
        if (Auth::user()->adm_add == 1){
            return view('admin.admin.add');
        }
        else {
            return redirect()->back();
        }
    }

    // Thêm
    public function create(Request $rq) {
        $this->validate($rq,
            [
                'adm_name' => 'required',
                'adm_login_name' => 'required|min:5|max:50|unique:admin_user,adm_login_name',
                'adm_password' => 'required|min:4|confirmed',
                'adm_email' => 'required|email|unique:admin_user,adm_email',
                'adm_phone'  => 'min:4| max:15',
                'adm_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role' => 'required'
            ],[
                'adm_name.required' => 'Họ tên không được để trống',
                'adm_login_name.required' => 'Tên đăng nhập không được để trống',
                'adm_login_name.min' => 'Tên đăng nhập quá ngắn',
                'adm_login_name.max' => 'Tên đăng nhập quá dài',
                'adm_login_name.unique' => 'Tên đăng nhập đã tồn tại',
                'adm_email.required' => 'Email không được để trống',
                'adm_email.email' => 'Email không đúng',
                'adm_email.unique' => 'Email đã tồn tại',
                'adm_password.required' => 'Bạn chưa nhập mật khẩu',
                'adm_password.confirmed' => 'Mật khẩu không khớp',
                'adm_password.min' => 'Mật khẩu quá ngắn',
                'adm_phone.min' => 'Số điện thoại không đúng',
                'adm_phone.max' => 'Số điện thoại không đúng',
                'adm_avatar.image' => 'File phải là ảnh',
                'adm_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );

        if($rq->hasFile('adm_avatar')){
            $image = $rq->adm_avatar;
            $img_name = date('y-m-d').'_'.$rq->adm_login_name.'_avatar.'.$image->getClientOriginalExtension();
            $resize = Image::make($image);
            $resize->resize(200,200)->encode('jpg');
            Storage::disk('user')->put($img_name,$resize->__toString());
        }

        $rq->offsetunset('_token');
        $role = $rq->role;
        if ($role == 'adm_add') {
            $rq->merge([
                'adm_active' => 0,
                'adm_add' => 1,
                'adm_edit' => 0,
                'adm_delete' => 0
            ]);
        }
        elseif($role == 'adm_edit') {
            $rq->merge([
                'adm_active' => 0,
                'adm_add' => 0,
                'adm_edit' => 1,
                'adm_delete' => 1
            ]);
        }
        $rq->merge([
            'adm_avatar'=>$img_name,
            'adm_password' => bcrypt($rq->adm_password)
        ]);
        // create new product
        if (Admin::create($rq->all())) {
            return redirect()->back()->with('success','Thêm mới tài khoản admin thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới tài khoản thất bại, vui lòng thử lại');
        }
    }

    public function edit($id){
        if (Auth::user()->adm_edit == 1){
            $admin = Admin::findOrFail($id);
            return view('admin.admin.edit',[
                'admin' => $admin,
            ]);
        }
        else {
            return redirect()->back();
        }
    }
    // Sửa
    public function update(Request $rq , $id){
        $admin = Admin::find($id);
//        dd($rq->hasFile('adm_avatar'));
        $this->validate($rq,
            [
                'adm_name' => 'required',
                'adm_password_old' => 'required',
                'adm_password' => 'required|min:4|confirmed',
                'adm_email' => 'required|email',
                'adm_phone'  => 'min:4| max:15',
                'adm_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'role' => 'required'
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

        $rq->offsetunset('_token');
        $current_password = $rq->adm_password_old;
        $new_password = $rq->adm_password;

        if (Hash::check($current_password, $admin->adm_password)){
            $role = $rq->role;
            if ($role == 'adm_add') {
                $admin->adm_active = 0;
                $admin->adm_add = 1;
                $admin->adm_edit = 0;
                $admin->adm_delete = 0;
            }
            elseif($role == 'adm_edit') {
                $admin->adm_active = 0;
                $admin->adm_add = 0;
                $admin->adm_edit = 1;
                $admin->adm_delete = 1;
            }
            if($rq->hasFile('adm_avatar')){
                Storage::disk('user')->delete($admin->adm_avatar);
                $image = $rq->adm_avatar;
                $img_name = date('y-m-d').'_'.$rq->adm_login_name.'_avatar.'.$image->getClientOriginalExtension();
                $resize = Image::make($image);
                $resize->resize(200,200)->encode('jpg');
                Storage::disk('user')->put($img_name,$resize->__toString());
            }
            $rq->merge([
                'adm_avatar'=>$img_name,
                'adm_password' => bcrypt($new_password)
            ]);
            $admin->adm_name = $rq->adm_name;
            $admin->adm_email = $rq->adm_email;
            $admin->adm_password = $rq->adm_password;
            $admin->adm_phone = $rq->adm_phone;
            $admin->adm_avatar = $rq->adm_avatar;
            $check = $admin->save();
            if ($check){
                return redirect()->route('administration')->with('success','Sửa tài khoản thành công');
            }
            else{
                return redirect()->back()->with('error','Sửa tài khoản thất bại, vui lòng thử lại');
            }
        }
        else{
            return redirect()->back()->with('error','Mật khẩu không khớp');
        }
    }
    // Xóa
    public function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $admin = Admin::findOrFail($id);
            if ($admin->delete()) {
                Storage::disk('user')->delete($admin->adm_avatar);
                return redirect()->back()->with('success','Xóa thành công');
            }
            else {
                return redirect()->back()->with('error','Xóa không thành công');
            }
        }
        else {
            return redirect()->back();
        }

    }
}
