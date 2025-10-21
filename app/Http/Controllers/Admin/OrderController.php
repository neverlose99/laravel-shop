<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index()
    {
        $orders = Order::with('user', 'orderItems')
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('user', 'orderItems.product')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    // Cập nhật trạng thái thanh toán
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,paid',
        ]);

        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thanh toán thành công!');
    }
}
