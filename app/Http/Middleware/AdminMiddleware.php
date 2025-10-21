<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Quan trọng
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Kiểm tra xem người dùng đã đăng nhập CHƯA
        // 2. Nếu đã đăng nhập, kiểm tra xem có phải là ADMIN không
        if (Auth::check() && Auth::user()->isAdmin()) {
            // Nếu đúng là Admin, cho phép đi tiếp
            return $next($request);
        }

        // Nếu không phải, ném ra lỗi 403 (Forbidden)
        abort(403, 'Bạn không có quyền truy cập vào trang này.');
    }
}