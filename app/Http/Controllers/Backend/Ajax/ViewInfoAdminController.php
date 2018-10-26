<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewInfoAdminController extends AjaxController
{
    public function ajaxInfo($id) {
        $admin_info = Admin::findOrFail($id);
        return view('backend.ajax.infor-admin-ajax',[
            'admin_info' => $admin_info
        ]);
    }
}
