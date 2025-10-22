@extends('layouts.app')

@section('content')
<div style="padding-top: 120px;"></div>

<main>
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title mb-4">
            <i class="fas fa-user-cog me-2"></i>Thông tin tài khoản
        </h2>

        @if(session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>Cập nhật thông tin thành công!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>Đổi mật khẩu thành công!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card profile-sidebar">
                    <div class="card-body text-center">
                        <div class="avatar-container mb-3">
                            <div class="avatar-circle">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                        </div>
                        <h5 class="mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted small mb-3">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->is_admin)
                            <span class="badge bg-danger mb-3">
                                <i class="fas fa-crown me-1"></i>Administrator
                            </span>
                        @endif
                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                            <a href="{{ route('checkout.orders') }}" class="btn btn-sm btn-outline-success">
                                <i class="fas fa-list me-2"></i>Đơn hàng
                            </a>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-cog me-2"></i>Admin Panel
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Update Profile Information -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>Cập nhật thông tin
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="fas fa-lock me-2"></i>Đổi mật khẩu
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="card border-danger">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>Xóa tài khoản
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="mb-5 pb-xl-5"></div>

<style>
.profile-sidebar {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: sticky;
    top: 140px;
}

.avatar-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.avatar-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 8px;
}

.card-header {
    border-bottom: 1px solid #dee2e6;
}

.page-title {
    font-size: 28px;
    font-weight: 600;
    color: #222;
}
</style>
@endsection
