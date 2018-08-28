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
            Thêm Quận Huyện
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('district')}}">District</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST" role="form">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Thêm mới</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên quận, huyện</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tên quận huyện" name="dis_name" id="name"  value="{{ old('dis_name') }}">
                                </div>
                                @if($errors->has('dis_name'))
                                    <div class="help-block text-red">
                                        * {!! $errors->first('dis_name') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Đường dẫn tĩnh</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" readonly placeholder="Đường dẫn tĩnh" name="dis_slug" id="slug"  value="{{ old('dis_slug') }}">
                                </div>
                                @if($errors->has('dis_slug'))
                                    <div class="help-block text-red">
                                        {!! $errors->first('dis_slug') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Thành phố</label>
                                <select class="form-control select2" style="width: 100%;" name="dis_cty_id">
                                    @foreach($cities as $city)
                                        <option value="{{$city->cty_id}}" >{{$city->cty_name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
    <!-- Select2 -->
    <script src="{{asset('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
        })
    </script>
@endsection