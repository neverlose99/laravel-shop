<x-guest-layout>
    @if (session('status'))
        <div class="alert alert-success mb-4" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    <!-- Thông báo yêu cầu đăng nhập -->
    @if (session('intended'))
        <div class="alert alert-info mb-4" role="alert">
            <strong>Vui lòng đăng nhập</strong> để tiếp tục!
            <br>
            <span class="small">Chưa có tài khoản? <a href="{{ route('register') }}" class="alert-link">Đăng ký ngay</a></span>
        </div>
    @endif
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
        </div>
        <div class="d-flex justify-content-end align-items-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none me-3" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <button type="submit" class="btn btn-primary">
                {{ __('Log in') }}
            </button>
        </div>
        
        <!-- Link đăng ký cho người dùng mới -->
        <div class="text-center mt-4 pt-3 border-top">
            <p class="mb-0">
                Don’t have an account? 
                <a href="{{ route('register') }}" class="text-decoration-none fw-bold">Sign up now</a>
            </p>
        </div>
    </form>
</x-guest-layout>