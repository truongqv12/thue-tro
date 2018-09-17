<!--/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/8/2018
 * Time: 2:07 PM
 */-->
@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')
    <link rel="stylesheet" href="{{asset('backend/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới người dùng
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('user')}}">user</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thông tin tài khoản</label>
                                <div class="input-group">
                                    <span class="input-group-addon">#</span>
                                    <input type="text" class="form-control" placeholder="Nhập họ và tên" name="use_name" value="{{ old('use_name') }}">
                                </div>
                            </div>
                            @if($errors->has('use_name'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('use_name') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="Email" name="use_email" value="{{ old('use_email') }}">
                                </div>
                            </div>
                            @if($errors->has('use_email'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('use_email') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="use_password">
                                </div>
                            </div>
                            @if($errors->has('use_password'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('use_password') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                    <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="use_password_confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" class="form-control" name="use_phone" value="{{ old('use_phone') }}" data-inputmask="'mask': ['9999999999[9]']" data-mask="" placeholder="Số điện thoại">
                                </div>
                            </div>
                            @if($errors->has('use_phone'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('use_phone') !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">#</span>
                                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="use_address" value="{{ old('use_address') }}">
                                </div>
                            </div>
                            @if($errors->has('use_address'))
                                <div class="help-block text-red">
                                    * {!! $errors->first('use_address') !!}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="radio">
                                    <label>
                                        <input checked type="radio" name="use_status" value="0">
                                        <span class="label label-danger">Ban</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="use_status" value="1">
                                        <span class="label label-success">Activated</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Avatar</label>
                                <div class="show-avatar">
                                    <img src="" alt="" id="img">
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
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-lg btn-primary center-block">Tạo mới</button>
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