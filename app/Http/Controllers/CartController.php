<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
            
        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        // Kiểm tra sản phẩm có tồn tại không
        $product = Product::findOrFail($productId);

        // Kiểm tra tồn kho
        if ($product->stock < $quantity) {
            return redirect()->back()->with('error', "Sản phẩm chỉ còn {$product->stock} trong kho!");
        }

        // Lấy user_id của user đang đăng nhập
        $userId = Auth::id();

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();

        if ($cartItem) {
            // Nếu đã có, kiểm tra tổng số lượng sau khi thêm
            $newQuantity = $cartItem->quantity + $quantity;
            
            if ($newQuantity > $product->stock) {
                return redirect()->back()->with('error', "Không thể thêm. Sản phẩm chỉ còn {$product->stock} trong kho và bạn đã có {$cartItem->quantity} trong giỏ!");
            }
            
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            // Nếu chưa có thì tạo mới
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    // Cập nhật số lượng sản phẩm
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('product')
            ->firstOrFail();
        
        // Kiểm tra tồn kho
        if ($request->quantity > $cartItem->product->stock) {
            return redirect()->route('cart.index')
                ->with('error', "Sản phẩm '{$cartItem->product->name}' chỉ còn {$cartItem->product->stock} trong kho!");
        }
            
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng!');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $cartItem = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa toàn bộ giỏ hàng!');
    }

    // Helper function để lấy cart items
    private function getCartItems()
    {
        return Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
    }

    // Đếm số lượng items trong giỏ hàng
    public function count()
    {
        $cartItems = $this->getCartItems();
        return response()->json(['count' => $cartItems->sum('quantity')]);
    }
}
