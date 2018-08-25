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

    protected function create(Request $rq){
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
        return view('backend.city.index');
    }

    protected function update(Request $rq, $id){
        return view('backend.city.index');
    }

    protected function delete( $id){
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
