{{-- resources/views/account/partials/navigation.blade.php --}}
<ul class="account-nav">
    {{-- Link đến Dashboard (trang hiện tại) --}}
    <li>
        <a href="{{ route('account.dashboard') }}"
           class="menu-link menu-link_us-s {{ request()->routeIs('account.dashboard') ? 'menu-link_active' : '' }}">
           Dashboard
        </a>
    </li>
    {{-- Link đến trang Orders (sẽ tạo route sau) --}}
    <li>
        <a href="#" {{-- Thay # bằng route('account.orders') sau --}}
           class="menu-link menu-link_us-s {{ request()->routeIs('account.orders') ? 'menu-link_active' : '' }}">
           Đơn hàng
        </a>
    </li>
    {{-- Link đến trang Addresses (sẽ tạo route sau) --}}
    <li>
        <a href="#" {{-- Thay # bằng route('account.addresses') sau --}}
           class="menu-link menu-link_us-s {{ request()->routeIs('account.addresses') ? 'menu-link_active' : '' }}">
           Địa chỉ
        </a>
    </li>
    {{-- Link đến trang Account Details (dùng route profile.edit của Breeze) --}}
    <li>
        <a href="{{ route('profile.edit') }}"
           class="menu-link menu-link_us-s {{ request()->routeIs('profile.edit') ? 'menu-link_active' : '' }}">
           Thông tin tài khoản
        </a>
    </li>
    {{-- Link đến trang Wishlist (sẽ tạo route sau) --}}
     <li>
        <a href="#" {{-- Thay # bằng route('account.wishlist') sau --}}
           class="menu-link menu-link_us-s {{ request()->routeIs('account.wishlist') ? 'menu-link_active' : '' }}">
           Danh sách yêu thích
        </a>
    </li>
    {{-- Nút Logout --}}
    <li>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form-account').submit();"
           class="menu-link menu-link_us-s">
           Đăng xuất
        </a>
    </li>
</ul>