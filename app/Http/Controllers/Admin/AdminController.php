<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::all();
        $columns = [
            'Họ tên', 'Tài khoản', 'Email', 'SĐT', 'Trạng thái', 'Quyền', 'Hành động'
        ];

        return view('admin.admin.index',[
            'admins' => $admins,
            'columns' => $columns,
        ]);
    }

    public function add() {
        return view('admin.admin.add');
    }

    public function create(Request $rq) {
//        $this->validate($rq,
//            [
//                'adm_name' => 'required',
//                'adm_login_name' => 'required|min:5|max:50|unique:admin_user,adm_login_name',
//                'adm_password' => 'required|min:4|confirmed',
//                'adm_email' => 'required|email|unique:admin_user,adm_email',
//                'adm_phone'  => 'min:4| max:15',
//                'adm_avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//                'role' => 'required'
//            ],[
//                'adm_name.required' => 'Họ tên không được để trống',
//                'adm_login_name.required' => 'Tên đăng nhập không được để trống',
//                'adm_login_name.min' => 'Tên đăng nhập quá ngắn',
//                'adm_login_name.max' => 'Tên đăng nhập quá dài',
//                'adm_login_name.unique' => 'Tên đăng nhập đã tồn tại',
//                'adm_email.required' => 'Email không được để trống',
//                'adm_email.email' => 'Email không đúng',
//                'adm_email.unique' => 'Email đã tồn tại',
//                'adm_password.required' => 'Bạn chưa nhập mật khẩu',
//                'adm_password.confirmed' => 'Mật khẩu không khớp',
//                'adm_password.min' => 'Mật khẩu quá ngắn',
//                'adm_phone.min' => 'Số điện thoại không đúng',
//                'adm_phone.max' => 'Số điện thoại không đúng',
//                'adm_avatar.image' => 'File phải là ảnh',
//                'adm_avatar.max' => 'Dung lượng file quá lớn',
//            ]
//        );
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
                'adm_delete' => 0
            ]);
        }
        if($rq->hasFile('upload_avatar')){
            $image = $rq->upload_avatar;
            $thumbnailImage = Image::make($image);
            $location_upload = storage_path('app\public\user\images\\');
            $img_name = time().'_'.$rq->adm_login_name.'_avatar.'.$image->getClientOriginalExtension();
            $thumbnailImage->resize(200,200);
            $thumbnailImage->save($location_upload.$img_name);
        }
        $rq->offsetunset('_token');
        $rq->merge([
            'adm_avatar'=>$img_name,
            'adm_password' => bcrypt($rq->adm_password)
        ]);
//        dd($rq->all());
        // create new product
        if (Admin::create($rq->all())) {
            return redirect()->back()->with('success','Thêm mới tài khoản admin thành công');
        }else{
            return redirect()->back()->with('error','Thêm mới tài khoản thất bại, vui lòng thử lại');
        }
    }
}
