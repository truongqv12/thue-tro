@extends('backend.layout.index')
@section('page_title','Thêm mới')
@section('link_css')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý địa điểm
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('city')}}">Street</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST" role="form">
            <section class="content">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Sửa</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <form action="" method="post" role="form">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tên đường</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Nhập tên phường xã" name="str_name" id="name"  value="{{$item->str_name}}">
                                        </div>
                                        @if($errors->has('str_name'))
                                            <div class="help-block text-red">
                                                * {!! $errors->first('str_name') !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Thuộc Quận, huyện</label>
                                        <select class="form-control select2" style="width: 100%;" name="str_dis_id">
                                            @foreach($districts as $district)
                                                <option value="{{$district->dis_id}}" {{($item->str_dis_id == $district->dis_id) ? 'selected' : ''}}>{{$district->dis_name . ' - ' . $district->city->cty_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="center-block max-width-content">
                            <a href="{{route('wards')}}" class="btn btn-lg btn-primary" style="margin-right: 10px">Quay lại</a>
                            <button type="submit" class="btn btn-lg btn-warning">Sửa <i class="fa fa-pencil-square-o"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        $('.treeview-location').addClass('active');
    </script>
@endsection