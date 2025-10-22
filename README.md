# 🛒 Laravel Shop - E-commerce Platform

Hệ thống thương mại điện tử đầy đủ tính năng được xây dựng bằng Laravel 10, Bootstrap 5 và MySQL.

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 📋 Mục lục

- [Tính năng](#-tính-năng)
- [Yêu cầu hệ thống](#-yêu-cầu-hệ-thống)
- [Cài đặt](#-cài-đặt)
- [Cấu hình](#-cấu-hình)
- [Sử dụng](#-sử-dụng)
- [Cấu trúc dự án](#-cấu-trúc-dự-án)
- [Screenshots](#-screenshots)
- [Công nghệ](#-công-nghệ)
- [License](#-license)

## ✨ Tính năng

### 👥 Khách hàng
- ✅ **Xác thực người dùng**: Đăng ký, đăng nhập, quên mật khẩu (Laravel Breeze)
- ✅ **Danh sách sản phẩm**: Hiển thị sản phẩm với hình ảnh, giá, tồn kho
- ✅ **Giỏ hàng**: Thêm/xóa sản phẩm, cập nhật số lượng, kiểm tra tồn kho
- ✅ **Thanh toán**: Form đầy đủ với 63 tỉnh/thành phố Việt Nam
- ✅ **Quản lý đơn hàng**: Xem lịch sử đơn hàng, chi tiết đơn hàng
- ✅ **Profile**: Cập nhật thông tin cá nhân, đổi mật khẩu, xóa tài khoản
- ✅ **Dashboard**: Thống kê đơn hàng, giỏ hàng, quick actions

### 🔧 Admin
- ✅ **Quản lý sản phẩm**: CRUD sản phẩm (tạo, đọc, cập nhật, xóa)
- ✅ **Quản lý đơn hàng**: Xem tất cả đơn hàng, chi tiết đơn hàng
- ✅ **Upload hình ảnh**: Hỗ trợ local storage và asset path
- ✅ **Admin panel**: Giao diện sidebar hiện đại với gradient

### 🎨 Giao diện
- ✅ **Responsive Design**: Tương thích mọi thiết bị
- ✅ **Bootstrap 5**: UI hiện đại, đẹp mắt
- ✅ **Font Awesome 6**: Icons đa dạng
- ✅ **Custom CSS**: Gradients, hover effects, animations

### 💳 Thanh toán
- ✅ **COD (Cash on Delivery)**: Thanh toán khi nhận hàng
- ✅ **Chuyển khoản ngân hàng**: Bank Transfer
- ✅ **MoMo**: Ví điện tử MoMo (sẵn sàng tích hợp)
- ✅ **VNPay**: Cổng thanh toán VNPay (sẵn sàng tích hợp)

### 🔒 Bảo mật & Validation
- ✅ **CSRF Protection**: Bảo vệ khỏi tấn công CSRF
- ✅ **Validation**: Kiểm tra dữ liệu đầu vào server-side & client-side
- ✅ **Phone validation**: Số điện thoại 10-12 chữ số, chỉ chấp nhận số
- ✅ **Address validation**: Tối thiểu 6 ký tự, yêu cầu tỉnh/thành phố
- ✅ **Stock management**: Kiểm tra tồn kho trước khi đặt hàng

## 💻 Yêu cầu hệ thống

- **PHP**: >= 8.1
- **Composer**: >= 2.0
- **MySQL**: >= 8.0 hoặc MariaDB >= 10.3
- **Node.js & NPM**: >= 16.x (cho build assets)
- **Web Server**: Apache hoặc Nginx

## 🚀 Cài đặt

### 1. Clone Repository

```bash
git clone https://github.com/neverlose99/laravel-shop.git
cd laravel-shop
```

### 2. Cài đặt Dependencies

```bash
# Cài đặt PHP dependencies
composer install

# Cài đặt Node dependencies
npm install
```

### 3. Cấu hình Environment

```bash
# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Cấu hình Database

Mở file `.env` và cập nhật thông tin database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_shop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Tạo Database & Migration

```bash
# Tạo database (nếu chưa có)
mysql -u root -p
CREATE DATABASE laravel_shop;
exit;

# Chạy migrations
php artisan migrate
```

### 6. Storage Link

```bash
# Tạo symbolic link cho storage
php artisan storage:link
```

### 7. Seed Data (Optional)

```bash
# Tạo dữ liệu mẫu
php artisan db:seed
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Chạy Server

```bash
php artisan serve
```

Truy cập: http://localhost:8000

## ⚙️ Cấu hình

### Timezone

Timezone mặc định: **Asia/Ho_Chi_Minh**

Nếu cần thay đổi, chỉnh sửa `config/app.php`:

```php
'timezone' => 'Asia/Ho_Chi_Minh',
```

### Admin Account

Để tạo tài khoản admin, sau khi đăng ký, cập nhật database:

```sql
UPDATE users SET is_admin = 1 WHERE email = 'your-email@example.com';
```

### Upload Images

Hình ảnh sản phẩm có thể lưu ở 2 nơi:
- `storage/app/public/products/` - Upload từ admin panel
- `public/assets/images/products/` - Hình ảnh có sẵn

Model `Product` tự động xử lý đường dẫn qua accessor `image_url`.

## 📖 Sử dụng

### Khách hàng

1. **Đăng ký tài khoản**: `/register`
2. **Đăng nhập**: `/login`
3. **Xem sản phẩm**: `/` hoặc `/home`
4. **Thêm vào giỏ hàng**: Click "Add to Cart"
5. **Xem giỏ hàng**: `/cart`
6. **Thanh toán**: `/checkout`
7. **Xem đơn hàng**: `/my-orders`

### Admin

1. **Đăng nhập admin**: `/login`
2. **Quản lý sản phẩm**: `/admin/products`
3. **Thêm sản phẩm**: `/admin/products/create`
4. **Sửa sản phẩm**: `/admin/products/{id}/edit`
5. **Quản lý đơn hàng**: `/admin/orders`
6. **Xem chi tiết đơn**: `/admin/orders/{id}`

## 📁 Cấu trúc dự án

```
laravel-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── OrderController.php      # Admin quản lý đơn hàng
│   │   │   │   └── ProductController.php    # Admin quản lý sản phẩm
│   │   │   ├── CartController.php           # Giỏ hàng
│   │   │   ├── CheckoutController.php       # Thanh toán
│   │   │   └── ProductController.php        # Sản phẩm (khách)
│   │   └── Middleware/
│   │       └── CheckAdmin.php               # Middleware kiểm tra admin
│   └── Models/
│       ├── Product.php                      # Model sản phẩm
│       ├── Cart.php                         # Model giỏ hàng
│       ├── Order.php                        # Model đơn hàng
│       ├── OrderItem.php                    # Model chi tiết đơn
│       └── User.php                         # Model người dùng
├── database/
│   └── migrations/
│       ├── 2025_10_15_075953_create_products_table.php
│       ├── xxxx_create_cart_table.php
│       ├── xxxx_create_orders_table.php
│       └── xxxx_create_order_items_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php                # Main layout
│       │   └── admin.blade.php              # Admin layout
│       ├── products/                        # Views sản phẩm
│       ├── cart/                            # Views giỏ hàng
│       ├── checkout/                        # Views thanh toán
│       ├── admin/
│       │   ├── products/                    # Admin CRUD sản phẩm
│       │   └── orders/                      # Admin quản lý đơn
│       ├── dashboard.blade.php              # User dashboard
│       └── profile/                         # Profile pages
└── routes/
    └── web.php                              # Định nghĩa routes
```

## 📸 Screenshots

### Trang chủ
Hiển thị danh sách sản phẩm với hình ảnh, giá, tồn kho và nút "Add to Cart".

### Giỏ hàng
Quản lý sản phẩm trong giỏ, cập nhật số lượng, xem tổng tiền.

### Checkout
Form thanh toán đầy đủ với dropdown 63 tỉnh/thành phố, validation số điện thoại.

### Dashboard
Thống kê đơn hàng (tổng, đang xử lý, hoàn thành), quick actions.

### Admin Panel
Sidebar hiện đại, quản lý sản phẩm và đơn hàng với table responsive.

## 🛠️ Công nghệ

### Backend
- **Laravel 10.x**: PHP Framework
- **Laravel Breeze**: Authentication scaffolding
- **MySQL**: Database
- **Eloquent ORM**: Database interactions

### Frontend
- **Bootstrap 5.3**: CSS Framework
- **Font Awesome 6.4**: Icon library
- **JavaScript**: Client-side validation & interactions
- **Blade**: Template engine

### Tools
- **Composer**: PHP dependency manager
- **NPM**: Node package manager
- **Vite**: Build tool

## 🔮 Tính năng sắp tới

- [ ] Tích hợp API thanh toán MoMo & VNPay
- [ ] Email thông báo đơn hàng
- [ ] Admin cập nhật trạng thái đơn hàng
- [ ] Hệ thống danh mục sản phẩm
- [ ] Tìm kiếm & lọc sản phẩm
- [ ] Wishlist (danh sách yêu thích)
- [ ] Đánh giá & review sản phẩm
- [ ] Coupon & mã giảm giá
- [ ] Export đơn hàng (PDF, Excel)
- [ ] Thống kê doanh thu cho admin

## 👨‍💻 Tác giả

**Hung Nguyen**
- GitHub: [@neverlose99](https://github.com/neverlose99)

## 📄 License

Dự án này được cấp phép theo giấy phép [MIT License](https://opensource.org/licenses/MIT).

## 🙏 Lời cảm ơn

- [Laravel](https://laravel.com) - Framework tuyệt vời
- [Bootstrap](https://getbootstrap.com) - UI Framework
- [Font Awesome](https://fontawesome.com) - Icons
- Cộng đồng Laravel Việt Nam

---

⭐ Nếu dự án hữu ích, hãy cho một star nhé! ⭐
