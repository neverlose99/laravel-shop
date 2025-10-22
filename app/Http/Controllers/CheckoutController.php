<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Hiển thị trang checkout
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống!');
        }

        // Tính tổng tiền
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Xử lý đặt hàng
    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|min:3|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|regex:/^[0-9]{10,12}$/|digits_between:10,12',
            'shipping_address' => 'required|string|min:6|max:500',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'nullable|string|max:255',
            'payment_method' => 'required|in:cod,bank_transfer,momo,vnpay',
            'note' => 'nullable|string|max:500',
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên',
            'customer_name.min' => 'Họ tên phải có ít nhất 3 ký tự',
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Email không hợp lệ',
            'customer_phone.required' => 'Vui lòng nhập số điện thoại',
            'customer_phone.regex' => 'Số điện thoại phải là 10-12 chữ số',
            'customer_phone.digits_between' => 'Số điện thoại phải có từ 10-12 chữ số',
            'shipping_address.required' => 'Vui lòng nhập địa chỉ giao hàng',
            'shipping_address.min' => 'Địa chỉ giao hàng phải có ít nhất 6 ký tự',
            'city.required' => 'Vui lòng chọn Tỉnh/Thành phố',
            'district.required' => 'Vui lòng chọn Quận/Huyện',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
        ]);

        try {
            DB::beginTransaction();

            // Lấy giỏ hàng
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('Giỏ hàng trống!');
            }

            // Kiểm tra tồn kho
            foreach ($cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception("Sản phẩm {$item->product->name} không đủ số lượng trong kho!");
                }
            }

            // Tính tổng tiền
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'shipping_address' => $validated['shipping_address'],
                'city' => $validated['city'] ?? null,
                'district' => $validated['district'] ?? null,
                'ward' => $validated['ward'] ?? null,
                'note' => $validated['note'] ?? null,
            ]);

            // Tạo order items và giảm tồn kho
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->quantity * $item->product->price,
                ]);

                // Giảm tồn kho
                $item->product->decrement('stock', $item->quantity);
            }

            // Xóa giỏ hàng
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Đặt hàng thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // Trang đặt hàng thành công
    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Kiểm tra xem order có thuộc về user hiện tại không
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    // Danh sách đơn hàng của user
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems')
            ->latest()
            ->paginate(10);

        return view('checkout.orders', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function orderDetail($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Kiểm tra xem order có thuộc về user hiện tại không
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.detail', compact('order'));
    }
}
