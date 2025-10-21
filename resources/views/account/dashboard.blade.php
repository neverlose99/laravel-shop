@extends('layouts.app') {{-- Kế thừa layout chung của trang web --}}

@section('title', 'My Account') {{-- Đặt tiêu đề cho trang --}}

@section('content')
<main class="pt-90"> {{-- Thêm class padding-top nếu layout của bạn chưa có --}}
    <div class="mb-4 pb-4"></div> {{-- Khoảng cách --}}
    <section class="my-account container">
        <h2 class="page-title">My Account</h2>
        <div class="row">
            {{-- Cột Menu bên trái --}}
            <div class="col-lg-3">
                {{-- Chúng ta sẽ nhúng menu vào đây từ file riêng --}}
                @include('account.partials.navigation')
            </div>

            {{-- Cột nội dung chính bên phải --}}
            <div class="col-lg-9">
                <div class="page-content my-account__dashboard">
                    {{-- Chào mừng người dùng bằng tên của họ --}}
                    <p>Xin chào <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>
                        Từ trang quản lý tài khoản, bạn có thể xem
                        <a class="unerline-link" href="#">đơn hàng gần đây</a>, {{-- Sẽ thêm link sau --}}
                        quản lý <a class="unerline-link" href="#">địa chỉ giao hàng</a>, {{-- Sẽ thêm link sau --}}
                        và <a class="unerline-link" href="{{ route('profile.edit') }}">chỉnh sửa mật khẩu và thông tin tài khoản.</a> {{-- Dùng route profile có sẵn của Breeze --}}
                    </p>
                    {{-- Form logout ẩn, sẽ được gọi từ menu --}}
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-account" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="mb-4 pb-4"></div> {{-- Khoảng cách dưới --}}
</main>
@endsection