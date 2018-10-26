<?php

namespace App\Http\Controllers\Backend;

use App\Models\District;
use App\Models\Street;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StreetController extends Controller
{
    public function index(){
        $streets = Street::all();
        $columns = [
            'Tên đường', 'Quận', 'Hành động'
        ];

        return view('backend.street.index',[
            'streets' => $streets,
            'columns' => $columns,
        ]);
    }

    public function add(){
        return view('backend.street.add', [
            'districts' => District::all()
        ]);
    }

    public function create(Request $rq){
        $this->validate($rq,
            [
                'str_name' => 'required|unique:streets,str_name,NULL,str_id,str_dis_id,'.$rq->input('str_dis_id'),
            ],[
                'str_name.required' => 'Tên đường không được để trống',
                'str_name.unique' => 'Đường đã được thêm trước đó',
            ]
        );
        $rq->offsetunset('_token');
        //tạo mới
        if (Street::create($rq->all())){
            return redirect()->back()->with('success','Thêm thành công');
        }
        else{
            return redirect()->back()->with('error','Thêm thất bại');
        }
    }

    public function edit($id){
        $item = Street::findOrFail($id);

        return view('backend.street.edit', [
            'item' => $item,
            'districts' => District::all()
        ]);
    }

    public function update(Request $rq, $id){
        $item = Street::findOrFail($id);

        $this->validate($rq,
            [
                'str_name' => 'required',
            ],[
                'str_name.required' => 'Tên phường xã không được để trống',
            ]
        );
        $rq->offsetunset('_token');

        $item->str_name = $rq->str_name;
        $item->str_dis_id = $rq->str_dis_id;
        $check = $item->save();
        if ($check){
            return redirect()->route('street')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    public function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $street = Street::findOrFail($id);
            if ($street->delete()) {
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
