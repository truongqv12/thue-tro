@extends('admin.layout.index')
@section('page_title','Administration')

@section('link_css')
  <link rel="stylesheet" href="{{asset('backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý Admin
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">administration</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Danh sách quản trị</h3>
            @if( Auth::user()->adm_add == 1 )
              <a href="{{route('administration_add')}}" class="btn btn-success btn-sm" style="margin-left: 10px"><i class="fa fa-plus-square"></i> Thêm mới </a>
            @endif
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                @foreach($columns as $column)
                  <th>{{$column}}</th>
                @endforeach
              </tr>
              </thead>
              <tbody>
                @foreach($admins as $admin)
                  <tr>
                    <td>{{$admin->adm_name}}</td>
                    <td>{{$admin->adm_login_name}}</td>
                    <td>{{$admin->adm_email}}</td>
                    <td>{{$admin->adm_phone}}</td>
                    <td>
                      @if($admin->adm_status == 1)
                        <label class="label label-success">Activated</label>
                      @else
                        <label class="label label-danger">Đợi duyệt</label>
                      @endif
                    </td>
                    <td>
                      @if($admin->adm_active == 1 && $admin->adm_add == 1 && $admin->adm_edit == 1 && $admin->adm_delete == 1)
                        <label class="label label-success">SuperAdmin</label>
                      @else
                        <label class="label label-warning">Mod</label>
                      @endif
                    </td>
                    <td>
                      <button class="btn label label-info"><i class="fa fa-eye"></i></button>
                      @if( Auth::user()->adm_edit == 1 )
                        <button class="btn label label-success"><i class="fa fa-pencil"></i></button>
                      @endif
                      @if($admin->adm_login_name != 'admin' && Auth::user()->adm_delete == 1)
                        <button class="btn label label-danger"><i class="fa fa-trash"></i></button>
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
  <!-- DataTables -->
  <script src="{{asset('backend/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

  <!-- page script -->
  <script>
  $(function () {
    $('#example1').DataTable()
  })
</script>
@endsection