<!--
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/15/2018
 * Time: 4:23 PM
 */-->
<div class="box box-primary">
    @if(isset($admin_info))
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/user/images/'.$admin_info->adm_avatar)}}" alt="User profile picture">

            <h3 class="profile-username text-center">{{$admin_info->adm_name}}</h3>

            <p class="text-muted text-center">
                @if($admin_info->adm_active == 1 && $admin_info->adm_add == 1 && $admin_info->adm_edit == 1 && $admin_info->adm_delete == 1)
                    <label class="label label-success">Super Admin</label>
                @elseif( $admin_info->adm_add == 1)
                    <label class="label label-violet">Mod Create</label>
                @elseif( $admin_info->adm_edit == 1)
                    <label class="label label-warning">Mod Edit</label>
                @endif
            </p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Email</b> <a class="pull-right text-bold">{{$admin_info->adm_email}}</a>
                </li>
                <li class="list-group-item">
                    <b>Ngày sinh</b> <a class="pull-right text-bold">27/7/2017</a>
                </li>
                <li class="list-group-item">
                    <b>SĐT</b> <a class="pull-right text-bold">{{ $admin_info->adm_phone}} </a>
                </li>
                <li class="list-group-item">
                    <b>Ngày tạo</b> <a class="pull-right text-bold"> {{$admin_info->created_at}}</a>
                </li>
            </ul>

            <a href="{{route('administration_edit', ['id'=>$admin_info->adm_id])}}" class="btn btn-danger btn-block"><b>Edit</b></a>
        </div>
        <!-- /.box-body -->
    @endif
</div>