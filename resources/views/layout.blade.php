<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
    @include('loader-style')
</head>
<body class="app">

@include('loader')
<div>
    <!-- #Left Sidebar ==================== -->
    <div class="sidebar">
        <div class="sidebar-inner">
            <!-- ### $Sidebar Header ### -->
            <div class="sidebar-logo">
                <div class="peers ai-c fxw-nw">
                    <div class="peer peer-greed">
                        <a class="sidebar-link td-n" href="/">
                            <div class="peers ai-c fxw-nw">
                                <div class="peer">
                                    <div class="logo">
                                        <img src="/assets/static/images/logo.png" alt="">
                                    </div>
                                </div>
                                <div class="peer peer-greed">
                                    <h5 class="lh-1 mB-0 logo-text">Quản lý sức khỏe</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="peer">
                        <div class="mobile-toggle sidebar-toggle">
                            <a href="" class="td-n">
                                <i class="ti-arrow-circle-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="sidebar-menu scrollable pos-r">
                <li class="nav-item mT-30 active">
                    <a class="sidebar-link" href="{{route('home')}}">
                <span class="icon-holder">
                  <i class="c-blue-500 ti-home"></i>
                </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->type == 2)
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('lecturers.index')}}">
                <span class="icon-holder">
                  <i class="c-brown-500 ti-email"></i>
                </span>
                        <span class="title">Quản lý giảng viên</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('departments.index')}}">
                <span class="icon-holder">
                  <i class="c-blue-500 ti-share"></i>
                </span>
                        <span class="title">Quản lý chuyên ngành</span>
                    </a>
                </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->type == 1)
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('healths.index')}}">
                <span class="icon-holder">
                  <i class="c-deep-orange-500 ti-calendar"></i>
                </span>
                        <span class="title">Quản lý sức khoẻ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('periodics.index')}}">
                <span class="icon-holder">
                  <i class="c-deep-purple-500 ti-comment-alt"></i>
                </span>
                        <span class="title">Quản lý đợt khám</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('drugs.index')}}">
                <span class="icon-holder">
                  <i class="c-indigo-500 ti-bar-chart"></i>
                </span>
                        <span class="title">Quản lý thuốc chữa bệnh</span>
                    </a>
                </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->type == 4)
                <li class="nav-item">
                    <a class='sidebar-link' href="{{route('healths-history')}}">
                <span class="icon-holder">
                  <i class="c-light-blue-500 ti-pencil"></i>
                </span>
                        <span class="title">Hồ sơ sức khỏe cá nhân</span>
                    </a>
                </li>
                    @endif
            </ul>
        </div>
    </div>
    <div class="modal fade" id="replace-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="/replace-password" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Đổi mật khẩu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Mật khẩu cũ</label>
                            <input type="password" class="form-control" name="old_password" required placeholder="Mật khẩu cũ">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu mới</label>
                            <input type="password" class="form-control" name="new_password" required placeholder="Mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control" name="rep_new_password" required placeholder="Nhập lại mật khẩu mới">
                        </div>
                    </div>
                    <div class="row" v-if="loading">
                        <div class="col-md-12">
                            <div class="loader">
                                <div class="loader-inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div class="header navbar">
            <div class="header-container">
                <ul class="nav-left">
                    <li>
                        <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
                            <i class="ti-menu"></i>
                        </a>
                    </li>
                    <li class="search-box">
                        <a class="search-toggle no-pdd-right" href="javascript:void(0);">
                            <i class="search-icon ti-search pdd-right-10"></i>
                            <i class="search-icon-close ti-close pdd-right-10"></i>
                        </a>
                    </li>
                    <li class="search-input">
                        <input class="form-control" type="text" placeholder="Search...">
                    </li>
                </ul>
                <ul class="nav-right">
                    <li class="notifications dropdown">
                        <span class="counter bgc-red">3</span>
                        <a href="" class="dropdown-toggle no-after" data-toggle="dropdown">
                            <i class="ti-bell"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="pX-20 pY-15 bdB">
                                <i class="ti-bell pR-10"></i>
                                <span class="fsz-sm fw-600 c-grey-900">Thông báo</span>
                            </li>
                            <li>
                                <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm">
                                    <li>
                                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                                            <div class="peer mR-15">
                                                <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                                            </div>
                                            <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">Phòng ban y tế</span>
                              <span class="c-grey-600">Vừa thêm mới 1 đợt khám bệnh
                              </span>
                            </span>
                                                <p class="m-0">
                                                    <small class="fsz-xs">5 mins ago</small>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                                            <div class="peer mR-15">
                                                <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                                            </div>
                                            <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">Phòng ban y tế</span>
                              <span class="c-grey-600">Vừa thêm mới 1 đợt khám bệnh
                              </span>
                            </span>
                                                <p class="m-0">
                                                    <small class="fsz-xs">5 mins ago</small>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
                                            <div class="peer mR-15">
                                                <img class="w-3r bdrs-50p" src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                                            </div>
                                            <div class="peer peer-greed">
                            <span>
                              <span class="fw-500">Phòng ban y tế</span>
                              <span class="c-grey-600">Vừa thêm mới 1 đợt khám bệnh
                              </span>
                            </span>
                                                <p class="m-0">
                                                    <small class="fsz-xs">5 mins ago</small>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="pX-20 pY-15 ta-c bdT">
                    <span>
                      <a href="" class="c-grey-600 cH-blue fsz-sm td-n">Xem tất cả thông báo <i class="ti-angle-right fsz-xs mL-10"></i></a>
                    </span>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                            <div class="peer mR-10">
                                <img class="w-2r bdrs-50p" src="https://randomuser.me/api/portraits/men/10.jpg" alt="">
                            </div>
                            <div clasAll rights reserved.s="peer">
                                <span class="fsz-sm c-grey-900">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu fsz-sm">
                            <li>
                                <a href="" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                    <i class="ti-user mR-10"></i>
                                    <span>Thông tin cá nhân</span>
                                </a>
                            </li>
                            <li>
                                <a href="" data-toggle="modal" data-target="#replace-password" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                    <i class="icon icon-lock"></i>
                                    <span>Đổi mật khẩu</span>
                                </a>
                            </li>
                            <li>
                                <a href="/logout" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700">
                                    <i class="ti-power-off mR-10"></i>
                                    <span>Đăng xuất</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <main class='main-content'>
            @section('main-content')
                @show
        </main>

        @include("footer")
    </div>
</div>
<script src="/js/common.js"></script>
@section('scripts') @show
</body>
</html>
