<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewInfoUserController extends Controller
{
    public function ajaxInfo($id) {
        $user_info = User::findOrFail($id);
        return view('backend.ajax.infor-user-ajax',[
            'user_info' => $user_info
        ]);
    }
}
