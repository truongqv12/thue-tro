<?php

namespace App\Http\Controllers\Backend;

use App\Models\District;
use App\Models\Wards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WardsController extends Controller
{
    public function index(){
        $wards = Wards::all();
        $columns = [
            'Tên phường, xã', 'Quận', 'Đường dẫn tĩnh', 'Hành động'
        ];

        return view('backend.wards.index',[
            'wards' => $wards,
            'columns' => $columns,
        ]);
    }

    public function add(){
        return view('backend.wards.add', [
            'districts' => District::all()
        ]);
    }

    protected function create(Request $rq){
        $this->validate($rq,
            [
                'war_name' => 'required|unique:wards,war_name,NULL,war_id,war_dis_id,'.$rq->input('war_dis_id'),
                'war_slug' => 'required|unique:wards,war_slug,NULL,war_id,war_dis_id,'.$rq->input('war_dis_id'),
            ],[
                'war_name.required' => 'Tên phường xã không được để trống',
                'war_name.unique' => 'Phường xã đã được thêm trước đó',
                'war_slug.required' => 'Đường dẫn không được để trống',
                'war_slug.unique' => 'Đường dẫn đã tồn tại',
            ]
        );
        $rq->offsetunset('_token');
        //tạo mới
        if (Wards::create($rq->all())){
            return redirect()->back()->with('success','Thêm thành công');
        }
        else{
            return redirect()->back()->with('error','Thêm thất bại');
        }
    }

    public function edit($id){
        $item = Wards::findOrFail($id);

        return view('backend.wards.edit', [
            'item' => $item,
            'districts' => District::all()
        ]);
    }

    protected function update(Request $rq, $id){
        $item = Wards::findOrFail($id);

        $dis_slug_old = $item->district->dis_slug;
        $dis_slug = District::findOrFail($rq->war_dis_id)->dis_slug;

        $this->validate($rq,
            [
                'war_name' => 'required|unique:wards,war_name,'.$item->war_id.',war_id',
                'war_slug' => 'required|unique:wards,war_slug,'.$item->war_id.',war_id',
            ],[
                'war_name.required' => 'Tên phường xã không được để trống',
                'war_name.unique' => 'Phường xã đã được thêm trước đó',
                'war_slug.required' => 'Đường dẫn không được để trống',
                'war_slug.unique' => 'Đường dẫn đã tồn tại',
            ]
        );
        $rq->offsetunset('_token');

        if ($item->war_slug !== $rq->war_slug){
            $item->war_slug = $rq->war_slug . '-' . $dis_slug;
        }

        if ($rq->war_dis_id !== $item->war_dis_id) {
            $item->war_slug = str_replace($dis_slug_old,$dis_slug,$item->war_slug);
        }

        $item->war_name = $rq->war_name;
        $item->war_dis_id = $rq->war_dis_id;
        $check = $item->save();
        if ($check){
            return redirect()->route('wards')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    protected function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $district = Wards::findOrFail($id);
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
