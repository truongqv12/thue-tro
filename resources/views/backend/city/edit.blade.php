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
            <li><a href="{{route('city')}}">City</a></li>
            <li class="active">Edit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="" method="POST" role="form">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Sửa</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tên thành phố</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" class="form-control" placeholder="Nhập tên thành phố" name="cty_name" id="name"  value="{{$item->cty_name}}">
                                </div>
                                @if($errors->has('cty_name'))
                                    <div class="help-block text-red">
                                        * {!! $errors->first('cty_name') !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="center-block max-width-content">
                        <a href="{{route('city')}}" class="btn btn-lg btn-primary" style="margin-right: 10px">Quay lại</a>
                        <button type="submit" class="btn btn-lg btn-warning">Sửa <i class="fa fa-pencil-square-o"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        $('.treeview-location').addClass('active');
    </script>
@endsection