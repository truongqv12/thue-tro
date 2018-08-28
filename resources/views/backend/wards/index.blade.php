@extends('backend.layout.index')
@section('page_title','Administration')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý địa chỉ
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Wards</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Quận \ Huyện</h3>
            @if( Auth::user()->adm_add == 1 )
              <a href="{{route('wards_add')}}" class="btn btn-success btn-sm" style="margin-left: 10px"><i class="fa fa-plus-square"></i> Thêm mới </a>
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
                @foreach($wards as $item)
                  <tr>
                    <td>{{$item->war_name}}</td>
                    <td>{{$item->district->dis_name . ' -- ' . $item->district->city->cty_name}}</td>
                    <td>{{$item->war_slug}}</td>
                    <td>
                      @if( Auth::user()->adm_edit == 1)
                        <a href="{{route('wards_edit',['id' => $item->war_id])}}" class="btn btn-action label label-success"><i class="fa fa-pencil"></i></a>
                      @endif
                      @if(Auth::user()->adm_delete == 1)
                        <a href="{{route('wards_delete',['id' => $item->war_id])}}" onclick="return confirm('Bạn có chắc muốn xóa: {{$item->war_name}}')" class="btn btn-action label label-danger"><i class="fa fa-trash"></i></a>
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
  })
</script>
@endsection