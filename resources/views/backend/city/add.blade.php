<!--/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/8/2018
 * Time: 2:07 PM
 */-->
@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới trường đại học
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('city')}}">City</a></li>
            <li class="active">Add</li>
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
                        <form action="" method="post" role="form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Tên thành phố</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Nhập họ và tên" name="cty_name" id="name"  value="{{ old('cty_name') }}">
                                    </div>
                                    @if($errors->has('cty_name'))
                                        <div class="help-block text-red">
                                            * {!! $errors->first('cty_name') !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col md-6">
                                <div class="form-group">
                                    <label for="">Đường dẫn tĩnh</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Đường dẫn tĩnh" name="cty_slug" id="slug"  value="{{ old('cty_slug') }}">
                                    </div>
                                    @if($errors->has('cty_slug'))
                                        <div class="help-block text-red">
                                            {!! $errors->first('cty_slug') !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
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
    <script src="{{asset('backend/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('backend/tinymce/config.js')}}"></script>
@endsection