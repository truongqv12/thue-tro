@extends('backend.layout.index')
@section('page_title','Administration')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý địa điểm
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">City</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Thành phố</h3>
            @if( Auth::user()->adm_add == 1 )
              <a href="{{route('city_add')}}" class="btn btn-success btn-sm" style="margin-left: 10px"><i class="fa fa-plus-square"></i> Thêm mới </a>
            @endif
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="data_table" class="table table-bordered table-striped">
              <thead>
              <tr>
                @foreach($columns as $column)
                  <th>{{$column}}</th>
                @endforeach
              </tr>
              </thead>
              <tbody>
                @foreach($cities as $item)
                  <tr>
                    <td>{{$item->cty_name}}</td>
                    <td>
                      @if( Auth::user()->adm_edit == 1)
                        <a href="{{route('city_edit',['id' => $item->cty_id])}}" class="btn btn-action label label-success"><i class="fa fa-pencil"></i></a>
                      @endif
                      @if(Auth::user()->adm_delete == 1)
                        <a href="{{route('city_delete',['id' => $item->cty_id])}}" onclick="return confirm('Bạn có chắc muốn xóa: {{$item->cty_name}}')" class="btn btn-action label label-danger"><i class="fa fa-trash"></i></a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                @foreach($columns as $column)
                  <th>{{$column}}</th>
                @endforeach
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

@endsection

@section('script')
  <script>
    $(function () {
      $('#data_table').DataTable()
    });
    $('.treeview-location').addClass('active');
  </script>
@endsection