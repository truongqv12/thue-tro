<!--/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/8/2018
 * Time: 2:07 PM
 */-->
@extends('backend.layout.index')
@section('page_title','Sửa')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chỉnh sửa
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('administration')}}">administration</a></li>
            <li class="active">edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Sửa tài khoản</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Minimal style -->
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Tên đăng nhập" name="adm_login_name" value="{{ $admin->adm_login_name }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option value="super_admin" {{($admin->adm_active == 1) ? 'selected' : ''}}>Super Admin</option>
                                    <option value="mod_create" {{($admin->adm_add == 1 && $admin->adm_edit == 0) ? 'selected' : ''}}>Mod Create</option>
                                    <option value="mod_edit" {{($admin->adm_edit == 1 && $admin->adm_add == 0) ? 'selected' : ''}}>Mod Edit</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Avatar</label>
                                <div class="show-avatar">
                                    <img src="{{asset('storage/user/images/'.$admin->adm_avatar)}}" alt="" id="img">
                                    <input type="file" name="upload_avatar" id="adm_avatar" style="display: none">
                                    <a id="browse_file" class="btn btn-success"><i class="fa fa-file-image-o"></i> Chọn avatar</a>
                                </div>
                            </div>
                            @if($errors->has('upload_avatar'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('upload_avatar') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label>Trạng thái</label>
                            <div class="radio">
                                <label>
                                    <input <?php $checked = ($admin->adm_status == 0) ? 'checked' : ''; ?> type="radio" name="adm_status" value="0" {{$checked}}>
                                    <span class="label label-danger">Ban</span>
                                </label>
                                <label>
                                    <input <?php $checked = ($admin->adm_status == 1) ? 'checked' : ''; ?> type="radio" name="adm_status" value="1" {{$checked}}>
                                    <span class="label label-success">Activated</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="center-block max-width-content">
                        <a href="{{route('administration')}}" class="btn btn-lg btn-primary" style="margin-right: 10px">Quay lại</a>
                        <button type="submit" class="btn btn-lg btn-warning">Sửa <i class="fa fa-pencil-square-o"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <!-- InputMask -->
    <script src="{{asset('backend/plugins/input-mask/jquery.inputmask.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            $('[data-mask]').inputmask();
        })
    </script>
@endsection