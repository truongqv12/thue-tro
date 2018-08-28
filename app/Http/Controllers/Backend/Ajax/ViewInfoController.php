<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewInfoController extends AjaxController
{
    public function ajaxInfo($id) {
        $admin_info = Admin::findOrFail($id);
        return view('backend.ajax.modal-ajax',[
            'admin_info' => $admin_info
        ]);
    }
}