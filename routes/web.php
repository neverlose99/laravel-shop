<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});
// --- ✅ NHÓM ROUTE MỚI CHO ADMIN ---
// Yêu cầu: 
// 1. Phải đăng nhập (`auth`)
// 2. Phải là admin (`admin`)
// 3. Đường dẫn bắt đầu bằng `/admin` (`prefix('admin')`)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Route: /admin/dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard'); // Đặt tên là 'admin.dashboard'

});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ✅ THÊM ROUTE NÀY: Route cho trang User Dashboard ("My Account")
    Route::get('/account', function () {
        return view('account.dashboard');
    })->name('account.dashboard'); // Đặt tên route là 'account.dashboard'
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\ProductController;

// ... các route khác

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

require __DIR__.'/auth.php';
