<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    public function index(){
        $districts = District::all();
        $columns = [
            'Tên quận, huyện', 'Thành Phố', 'Hành động'
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
        $this->validate($rq,
            [
                'dis_name' => 'required|unique:districts,dis_name,NULL,dis_id,dis_cty_id,'.$rq->input('dis_cty_id'),
            ],[
                'dis_name.required' => 'Tên quận huyện không được để trống',
                'dis_name.unique' => 'Quận, huyện đã được thêm trước đó',
            ]
        );
        $rq->offsetunset('_token');
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
        $district = District::findOrFail($id);
        $this->validate($rq,
            [
                'dis_name' => 'required|unique:districts,dis_name,' . $district->dis_id .',dis_id' ,
            ], [
                'dis_name.required' => 'Tên quận huyện không được để trống',
                'dis_name.unique' => 'Quận, huyện đã được thêm trước đó',
            ]
        );
        $rq->offsetunset('_token');

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
            $row = DB::table('wards')->where('war_dis_id','=',$id)->get();
            if($row->toArray()){
                return redirect()->back()->with('error','Xóa không thành công, bạn phải xóa những phường xã thuộc quận '. $district->dis_name . ' trước');
            }
            else {
                if ($district->delete()) {
                    return redirect()->back()->with('success','Xóa thành công');
                }
                else {
                    return redirect()->back()->with('error','Xóa không thành công');
                }
            }
        }
        else {
            return redirect()->back();
        }
    }
}
