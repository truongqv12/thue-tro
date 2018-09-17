<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        $columns = [
            'Họ tên', 'Email', 'Avatar', 'SĐT', 'Trạng thái', 'Hành động'
        ];

        return view('backend.user.index',[
            'users' => $users,
            'columns' => $columns,
        ]);
    }

    public function add(){
        return view('backend.user.add');
    }

    public function create(Request $rq) {

        $this->validate($rq,
            [
                'use_name' => 'required',
                'use_email' => 'required|email|unique:users,use_email',
                'use_password' => 'required|min:4|confirmed',
                'use_phone'  => 'min:4| max:15',
                'upload_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'use_name.required' => 'Họ tên không được để trống',
                'use_email.required' => 'Email không được để trống',
                'use_email.email' => 'Email không đúng',
                'use_email.unique' => 'Email đã tồn tại',
                'use_password.required' => 'Bạn chưa nhập mật khẩu',
                'use_password.confirmed' => 'Mật khẩu không khớp',
                'use_password.min' => 'Mật khẩu quá ngắn',
                'use_phone.min' => 'Số điện thoại không đúng',
                'use_phone.max' => 'Số điện thoại không đúng',
                'upload_avatar.image' => 'File phải là ảnh',
                'upload_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );

        $rq->offsetunset('_token');
        $img_name = '';
        if($rq->hasFile('upload_avatar')){
            $image = $rq->upload_avatar;
            $img_name = $image->hashName();
            $ext = $image->getClientOriginalExtension();
            $img_name = str_replace($ext,'jpg', $img_name);
            $resize = Image::make($image);
            $resize->resize(200,200)->encode('jpg');
            Storage::disk('user')->put($img_name,$resize->__toString());
        }

        $rq->merge([
            'use_avatar' => $img_name,
            'use_password' => bcrypt($rq->use_password)
        ]);
        // create new product
        if (User::create($rq->all())) {
            return redirect()->back()->with('success','Thêm mới tài khoản người dùng thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới tài khoản thất bại, vui lòng thử lại');
        }
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('backend.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $rq, $id){
        $user = User::findOrFail($id);
        $this->validate($rq,
            [
                'use_name' => 'required',
                'use_email' => 'required|email|unique:users,use_email,'.$user->use_id.',use_id',
                'use_phone'  => 'min:4| max:15',
                'upload_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],[
                'use_name.required' => 'Họ tên không được để trống',
                'use_email.required' => 'Email không được để trống',
                'use_email.email' => 'Email không đúng',
                'use_email.unique' => 'Email đã tồn tại',
                'use_phone.min' => 'Số điện thoại không đúng',
                'use_phone.max' => 'Số điện thoại không đúng',
                'upload_avatar.image' => 'File phải là ảnh',
                'upload_avatar.max' => 'Dung lượng file quá lớn',
            ]
        );
        $rq->offsetunset('_token');
        if($rq->hasFile('upload_avatar')){
            Storage::disk('user')->delete($user->use_avatar);
            $image = $rq->upload_avatar;
            $img_name = $image->hashName();
            $ext = $image->getClientOriginalExtension();
            $img_name = str_replace($ext,'jpg', $img_name);
            $resize = Image::make($image);
            $resize->resize(200,200)->encode('jpg');
            Storage::disk('user')->put($img_name,$resize->__toString());
            $user->use_avatar = $img_name;
        }

        $user->use_name = $rq->use_name;
        $user->use_email = $rq->use_email;
        $user->use_address = $rq->use_address;
        $user->use_phone = $rq->use_phone;
        $user->use_status = $rq->use_status;
        $check = $user->save();
        if ($check){
            return redirect()->route('user')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    public function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $user = User::findOrFail($id);
            if ($user->delete()) {
                Storage::disk('user')->delete($user->use_avatar);
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
