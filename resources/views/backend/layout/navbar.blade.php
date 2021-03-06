<!--/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 8/7/2018
 * Time: 9:19 AM
 */-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ (Auth::user()->adm_avatar == null) ? asset('backend/dist/img/user2-160x160.jpg') : asset('storage/user/images/'.Auth::user()->adm_avatar) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->adm_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li>
                <a href="{{route('administration')}}">
                    <i class="fa fa-life-bouy"></i> <span>Admin</span>
                </a>
            </li>
            <li>
                <a href="{{route('user')}}">
                    <i class="fa fa-users"></i> <span>Quản lý người dùng</span>
                </a>
            </li>
            <li class="treeview treeview-location">
                <a href="#">
                    <i class="fa fa-map-o"></i>
                    <span>Địa điểm</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('city')}}"><i class="fa fa-circle-o"></i> Thành phố </a></li>
                    <li><a href="{{route('district')}}"><i class="fa fa-circle-o"></i> Quận/Huyện </a></li>
                    <li><a href="{{route('wards')}}"><i class="fa fa-circle-o"></i> Phường/Xã </a></li>
                    <li><a href="{{route('street')}}"><i class="fa fa-circle-o"></i> Đường </a></li>
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-university"></i> <span>Danh sách trường đại học</span>
                </a>
            </li>
            <li>
                <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>