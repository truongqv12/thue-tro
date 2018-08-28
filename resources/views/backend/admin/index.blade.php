@extends('backend.layout.index')
@section('page_title','Administration')

@section('custom_css')
  <style>
  </style>
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
            <table id="data_table" class="table table-bordered table-striped">
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
                    <td><img src="{{asset('storage/user/images/'.$admin->adm_avatar)}}" alt="" style="width: 40px; height: 40px" title="{{$admin->adm_avatar}}"></td>
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
                        <label class="label label-success">Super Admin</label>
                      @elseif( $admin->adm_add == 1)
                        <label class="label label-violet">Mod Create</label>
                      @elseif( $admin->adm_edit == 1)
                        <label class="label label-warning">Mod Edit</label>
                      @endif
                    </td>
                    <td>
                      <a href="" class="btn btn-action label label-info ajax-show-info" data-id="{{$admin->adm_id}}" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                      @if( Auth::user()->adm_edit == 1 && $admin->adm_login_name != 'admin')
                        <a href="{{route('administration_edit',['id'=>$admin->adm_id])}}" class="btn btn-action label label-success"><i class="fa fa-pencil"></i></a>
                      @endif
                      @if($admin->adm_login_name != 'admin' && Auth::user()->adm_delete == 1)
                        <a href="{{route('administration_delete',['id'=>$admin->adm_id])}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-action label label-danger"><i class="fa fa-trash"></i></a>
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
  <div class="modal modal-admin-style fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Thông tin</h4>
        </div>
        <div class="modal-body">
          <div class="loading_view" style="background: url('{{asset('backend/images/loading.gif')}}') no-repeat center center"></div>
          <div class="load_content_modal_ajax"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

@endsection

@section('script')

  <script>
  $(function () {
    $('#data_table').DataTable()
  })
</script>
@endsection