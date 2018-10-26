@extends('backend.layout.index')
@section('page_title','Quản lý người dùng')

@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý người dùng
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">User</li>

    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Quản lý người dùng</h3>
            @if( Auth::user()->adm_add == 1 )
              <a href="{{route('user_add')}}" class="btn btn-success btn-sm" style="margin-left: 10px"><i class="fa fa-plus-square"></i> Thêm mới </a>
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
                @foreach($users as $user)
                  <tr>
                    <td>{{$user->use_name}}</td>
                    <td>{{$user->use_email}}</td>
                    <td><img src="{{asset('storage/user/images/'.$user->use_avatar)}}" alt="" style="width: 40px; height: 40px" title="{{$user->use_avatar}}"></td>
                    <td>{{$user->use_phone}}</td>
                    <td>
                      @if($user->use_status == 1)
                        <label class="label label-success">Activated</label>
                      @else
                        <label class="label label-danger">Đợi duyệt</label>
                      @endif
                    </td>
                    <td>
                      <a href="" class="btn btn-action label label-info ajax-show-info" data-url="{{'info-user/' . $user->use_id}}" data-toggle="modal" data-target="#modal-default"><i class="fa fa-eye"></i></a>
                      @if(Auth::user()->adm_edit == 1)
                        <a href="{{route('user_edit',['id'=>$user->use_id])}}" class="btn btn-action label label-success"><i class="fa fa-pencil"></i></a>
                      @endif
                      @if(Auth::user()->adm_delete == 1)
                        <a href="{{route('user_delete',['id'=>$user->use_id])}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-action label label-danger"><i class="fa fa-trash"></i></a>
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
@endsection

@section('script')
  <script>
  $(function () {
    $('#data_table').DataTable()
  })
</script>
@endsection