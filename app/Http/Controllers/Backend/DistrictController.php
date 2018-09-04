<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    public function index(){
        $districts = District::all();
        $columns = [
            'Tên quận, huyện', 'Thành Phố', 'Đường dẫn tĩnh', 'Hành động'
        ];

        return view('backend.district.index',[
            'districts' => $districts,
            'columns' => $columns,
        ]);
    }

    public function add(){
        return view('backend.district.add', [
            'cities' => City::all()
        ]);
    }

    public function create(Request $rq){
        $cty_slug = City::findOrFail($rq->dis_cty_id)->cty_slug;
        $this->validate($rq,
            [
                'dis_name' => 'required|unique:districts,dis_name,NULL,dis_id,dis_cty_id,'.$rq->input('dis_cty_id'),
                'dis_slug' => 'required|unique:districts,dis_slug,NULL,dis_id,dis_cty_id,'.$rq->input('dis_cty_id'),
            ],[
                'dis_name.required' => 'Tên quận huyện không được để trống',
                'dis_name.unique' => 'Quận, huyện đã được thêm trước đó',
                'dis_slug.required' => 'Tên đăng nhập không được để trống',
                'dis_slug.unique' => 'Đường dẫn đã tồn tại',
            ]
        );
        $rq->offsetunset('_token');
        $rq->merge([
            'dis_slug' => $rq->dis_slug .'-'. $cty_slug
        ]);
        //tạo mới
        if (District::create($rq->all())){
            return redirect()->back()->with('success','Thêm thành công');
        }
        else{
            return redirect()->back()->with('error','Thêm thất bại');
        }
    }

    public function edit($id){
        $district = District::findOrFail($id);
        return view('backend.district.edit', [
            'item' => $district,
            'cities' => City::all()
        ]);
    }

    public function update(Request $rq, $id)
    {
        $cty_slug = City::findOrFail($rq->dis_cty_id)->cty_slug;
        $district = District::findOrFail($id);
        $cty_slug_old = $district->city->cty_slug;
        $this->validate($rq,
            [
                'dis_name' => 'required|unique:districts,dis_name,' . $district->dis_id . ',dis_id',
                'dis_slug' => 'required|unique:districts,dis_slug,' . $district->dis_id . ',dis_id',
            ], [
                'dis_name.required' => 'Tên quận huyện không được để trống',
                'dis_name.unique' => 'Quận, huyện đã được thêm trước đó',
                'dis_slug.required' => 'Tên đăng nhập không được để trống',
                'dis_slug.unique' => 'Đường dẫn đã tồn tại',
            ]
        );
        $rq->offsetunset('_token');

        if ($district->dis_slug !== $rq->dis_slug){
            $district->dis_slug = $rq->dis_slug . '-' . $cty_slug;
        }

        if ($rq->dis_cty_id !== $district->dis_cty_id) {
            $district->dis_slug = str_replace($cty_slug_old,$cty_slug,$district->dis_slug);
        }

        $district->dis_name = $rq->dis_name;
        $district->dis_cty_id = $rq->dis_cty_id;
        $check = $district->save();
        if ($check){
            return redirect()->route('district')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    public function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $district = District::findOrFail($id);
            if ($district->delete()) {
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
