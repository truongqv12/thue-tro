<?php

namespace App\Http\Controllers\Backend;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index(){
        $cities = City::all();
        $columns = [
            'Tên thành phố', 'Đường dẫn tĩnh', 'Hành động'
        ];

        return view('backend.city.index',[
            'cities' => $cities,
            'columns' => $columns,
        ]);
    }

    public function add(){
        return view('backend.city.add');
    }

    public function create(Request $rq){
        $this->validate($rq,
            [
                'cty_name' => 'required|unique:cities,cty_name',
                'cty_slug' => 'required|unique:cities,cty_slug',
            ],[
                'cty_name.required' => 'Tên thành phố không được để trống',
                'cty_name.unique' => 'Thành phố đã được thêm trước đó',
                'cty_slug.required' => 'Tên đăng nhập không được để trống',
                'cty_slug.unique' => 'Đường dẫn đã tồn tại',
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
        $city = City::findOrFail($id);
        return view('backend.city.edit', [
            'item' => $city
        ]);
    }

    public function update(Request $rq, $id){
        $city = City::findOrFail($id);
        $this->validate($rq,
            [
                'cty_name' => 'required|unique:cities,cty_name,'.$city->cty_id.',cty_id',
                'cty_slug' => 'required|unique:cities,cty_slug,'.$city->cty_id.',cty_id',
            ],
            [
                'cty_name.required' => 'Tên thành phố không được để trống',
                'cty_name.unique' => 'Thành phố đã được thêm trước đó',
                'cty_slug.required' => 'Tên đăng nhập không được để trống',
                'cty_slug.unique' => 'Đường dẫn đã tồn tại',
            ]
        );
        $rq->offsetunset('_token');
        $city->cty_name = $rq->cty_name;
        $city->cty_slug = $rq->cty_slug;
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
            if ($city->delete()) {
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
