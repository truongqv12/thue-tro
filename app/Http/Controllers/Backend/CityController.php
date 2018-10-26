<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        $columns = [
            'Tên thành phố', 'Hành động'
        ];

        return view('backend.city.index',[
            'cities' => $cities,
            'columns' => $columns,
        ]);
    }

    public function add(){
        if (Auth::user()->adm_edit == 1) {
            return view('backend.city.add');
        }
        else {
            return redirect()->back();
        }
    }

    public function create(Request $rq){
        $this->validate($rq,
            [
                'cty_name' => 'required|unique:cities,cty_name',
            ],[
                'cty_name.required' => 'Tên thành phố không được để trống',
                'cty_name.unique' => 'Thành phố đã được thêm trước đó',
            ]
        );
        $rq->offsetunset('_token');
    //tạo mới
        if (City::create($rq->all())){
            return redirect()->back()->with('success','Thêm thành công');
        }
        else{
            return redirect()->back()->with('error','Thêm thất bại');
        }
    }

    public function edit($id){
        if (Auth::user()->adm_edit == 1) {
            $city = City::findOrFail($id);
            return view('backend.city.edit', [
                'item' => $city
            ]);
        }
        else {
            return redirect()->back();
        }
    }

    public function update(Request $rq, $id){
        $city = City::findOrFail($id);
        $this->validate($rq,
            [
                'cty_name' => 'required|unique:cities,cty_name,'.$city->cty_id.',cty_id',
            ],
            [
                'cty_name.required' => 'Tên thành phố không được để trống',
                'cty_name.unique' => 'Thành phố đã được thêm trước đó',
            ]
        );
        $rq->offsetunset('_token');
        $city->cty_name = $rq->cty_name;
        $check = $city->save();
        if ($check){
            return redirect()->route('city')->with('success','Sửa thành công');
        }
        else{
            return redirect()->back()->with('error','Sửa thất bại, vui lòng thử lại');
        }
    }

    public function delete($id){
        if (Auth::user()->adm_delete == 1) {
            $city = City::findOrFail($id);
            $row = DB::table('districts')->where('dis_cty_id','=',$id)->get();
            if($row->toArray()){
                return redirect()->back()->with('error','Xóa không thành công, bạn phải xóa những quận huyện thuộc thành phố '. $city->cty_name . ' trước');
            }
            else {
                if ($city->delete()) {
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
