<!--/ **
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/15/2018
 * Time: 9:24 AM
 */ -->
@extends('admin.layout.index')

@section('page_title','Profile')

@section('content')
    <section class="content-header">
        <h1>
            Trang cá nhân
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/user/images/'.Auth::user()->adm_avatar)}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{Auth::user()->adm_name}}</h3>

                        <p class="text-muted text-center">
                            @if(Auth::user()->adm_active == 1 && Auth::user()->adm_add == 1 && Auth::user()->adm_edit == 1 && Auth::user()->adm_delete == 1)
                                <label class="label label-success">Super Admin</label>
                            @elseif( Auth::user()->adm_add == 1)
                                <label class="label label-violet">Mod Create</label>
                            @elseif( Auth::user()->adm_edit == 1)
                                <label class="label label-warning">Mod Edit</label>
                            @endif
                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#activity" data-toggle="tab">Activity</a></li>
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="settings">
                            <form action="" method="POST" role="form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thông tin tài khoản</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="text" class="form-control" placeholder="Nhập họ và tên" name="adm_name"  value="{{ Auth::user()->adm_name }}">
                                            </div>
                                        </div>
                                        @if($errors->has('adm_name'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_name') !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="adm_login_name" value="{{ Auth::user()->adm_login_name }}" readonly>
                                            </div>
                                        </div>
                                        @if($errors->has('adm_login_name'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_login_name') !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input type="email" class="form-control" placeholder="Email" name="adm_email" value="{{ Auth::user()->adm_email }}">
                                            </div>
                                        </div>
                                        @if($errors->has('adm_email'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_email') !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                                <input type="password" class="form-control" placeholder="Nhập mật khẩu cũ" name="adm_password_old">
                                            </div>
                                        </div>
                                        @if($errors->has('adm_password_old'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_password_old') !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                                <input type="password" class="form-control" placeholder="Nhập mật khẩu mới" name="adm_password">
                                            </div>
                                        </div>
                                        @if($errors->has('adm_password'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_password') !!}
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-eye-slash"></i></span>
                                                <input type="password" class="form-control" placeholder="Nhập lại mật khẩu" name="adm_password_confirmation">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" name="adm_phone" value="{{ Auth::user()->adm_phone }}" data-inputmask="'mask': ['9999999999[9]']" data-mask="" placeholder="Số điện thoại">
                                            </div>
                                        </div>
                                        @if($errors->has('adm_phone'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_phone') !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Minimal style -->
                                        <div class="form-group">
                                            <label>Avatar</label>
                                            <div class="show-avatar">
                                                <img src="{{asset('storage/user/images/'.Auth::user()->adm_avatar)}}" alt="" id="img">
                                                <input type="file" name="adm_avatar" id="adm_avatar" style="display: none">
                                                <a id="browse_file" class="btn btn-success"><i class="fa fa-file-image-o"></i> Chọn avatar</a>
                                            </div>
                                        </div>
                                        @if($errors->has('adm_avatar'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('adm_avatar') !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-lg btn-danger center-block">Sửa</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection