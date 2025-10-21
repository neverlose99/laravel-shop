<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Laravel') }}</title> {{-- Tiêu đề động --}}
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- CSRF Token --}}

    {{-- Assets cho Admin --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/animation.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/bootstrap.css') }}"> --}} {{-- Cân nhắc xóa --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/font/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/icon/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/images/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('admin_assets/images/favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin_assets/css/custom.css') }}">

    {{-- Bootstrap CSS chính từ Vite --}}
    @vite(['resources/scss/app.scss'])
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                {{-- Menu Bên Trái --}}
                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
                            <img class="" id="logo_header" alt="" src="{{ asset('admin_assets/images/logo/logo.png') }}"
                                 data-light="{{ asset('admin_assets/images/logo/logo.png') }}" data-dark="{{ asset('admin_assets/images/logo/logo.png') }}">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                {{-- Dashboard Link --}}
                                <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <a href="{{ route('admin.dashboard') }}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                                {{-- Thêm các menu khác khi cần --}}
                            </ul>
                        </div>
                        <div class="center-item">
                             <div class="center-heading">Management</div>
                             <ul class="menu-list">
                                <li class="menu-item has-children {{ request()->is('admin/products*') ? 'active' : '' }}"> {{-- Active state cho group --}}
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Products</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            {{-- Sửa route khi bạn tạo controller/route tương ứng --}}
                                            <a href="#" class="">
                                                <div class="text">Add Product</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                             {{-- Sửa route khi bạn tạo controller/route tương ứng --}}
                                            <a href="#" class="">
                                                <div class="text">Products List</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- Thêm Brand, Category, Order... tương tự --}}
                                <li class="menu-item">
                                     {{-- Sửa route khi bạn tạo controller/route tương ứng --}}
                                    <a href="#" class="">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Users</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                     {{-- Sửa route khi bạn tạo controller/route tương ứng --}}
                                    <a href="#" class="">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="section-content-right">
                    {{-- Header Dashboard --}}
                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                {{-- Logo cho mobile --}}
                                <a href="{{ route('admin.dashboard') }}">
                                    <img class="" id="logo_header_mobile" alt="" src="{{ asset('admin_assets/images/logo/logo.png') }}"
                                         data-light="{{ asset('admin_assets/images/logo/logo.png') }}" data-dark="{{ asset('admin_assets/images/logo/logo.png') }}"
                                         data-width="154px" data-height="52px" data-retina="{{ asset('admin_assets/images/logo/logo.png') }}">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>
                                {{-- Form Search (giữ nguyên hoặc tùy chỉnh sau) --}}
                                <form class="form-search flex-grow">
                                    {{-- ... (nội dung form search) ... --}}
                                </form>
                            </div>
                            <div class="header-grid">
                                {{-- Thông báo (giữ nguyên hoặc tùy chỉnh sau) --}}
                                <div class="popup-wrap message type-header">
                                    {{-- ... (nội dung dropdown thông báo) ... --}}
                                </div>

                                {{-- User Dropdown --}}
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    {{-- Ảnh đại diện mặc định hoặc lấy từ user nếu có --}}
                                                    <img src="{{ asset('admin_assets/images/avatar/user-1.png') }}" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    {{-- Tên người dùng đang đăng nhập --}}
                                                    <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                                    <span class="text-tiny">Admin</span>
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                {{-- Link đến trang profile (cần tạo route sau) --}}
                                                <a href="#" class="user-item">
                                                    <div class="icon"><i class="icon-user"></i></div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            {{-- Các link khác nếu cần --}}
                                            <li>
                                                {{-- Form Logout --}}
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                                       class="user-item">
                                                        <div class="icon"><i class="icon-log-out"></i></div>
                                                        <div class="body-title-2">Log out</div>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nội dung chính của từng trang Admin --}}
                    <div class="main-content">
                        @yield('content') {{-- Đây là nơi nội dung sẽ được chèn vào --}}
                    </div>

                    {{-- Footer nhỏ ở dưới --}}
                    <div class="bottom-page">
                        <div class="body-text">Copyright © {{ date('Y') }} {{ config('app.name') }}</div> {{-- Năm động --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Assets JS cho Admin --}}
    <script src="{{ asset('admin_assets/js/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script> --}} {{-- ĐÃ COMMENT/XÓA --}}
    <script src="{{ asset('admin_assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>

    {{-- Bootstrap JS chính từ Vite --}}
    @vite(['resources/js/app.js'])

    {{-- Dành cho JS của từng trang cụ thể --}}
    @stack('scripts')
</body>
</html>