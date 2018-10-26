<!--
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/15/2018
 * Time: 4:23 PM
 */-->
<div class="box box-primary">
    @if(isset($user_info))
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="{{asset('storage/user/images/'.$user_info->use_avatar)}}" alt="User profile picture">

            <h3 class="profile-username text-center">{{$user_info->use_name}}</h3>

            <p class="text-muted text-center">
                @if( $user_info->use_status == 1)
                    <label class="label label-success">Active</label>
                @elseif( $user_info->use_status == 0)
                    <label class="label label-danger">Chờ duyệt</label>
                @endif
            </p>

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Email</b> <a class="pull-right text-bold">{{$user_info->use_email}}</a>
                </li>
                <li class="list-group-item">
                    <b>Ngày sinh</b> <a class="pull-right text-bold">
                        {{($user_info->use_birthday) ? $user_info->use_birthday : 'Chưa cập nhật'}}
                    </a>
                </li>
                <li class="list-group-item">
                    <b>SĐT</b> <a class="pull-right text-bold">{{($user_info->use_phone) ? $user_info->use_phone : 'Chưa cập nhật'}} </a>
                </li>
                <li class="list-group-item">
                    <b>Địa chỉ</b> <a class="pull-right text-bold">{{($user_info->use_address) ? $user_info->use_address : 'Chưa cập nhật'}} </a>
                </li>
                <li class="list-group-item">
                    <b>Ngày tạo</b> <a class="pull-right text-bold"> {{$user_info->created_at}}</a>
                </li>
            </ul>
            <a href="{{route('user_edit', ['id'=>$user_info->use_id])}}" class="btn btn-danger btn-block pull-right"><b>Edit</b></a>
        </div>
        <!-- /.box-body -->
    @endif
</div>