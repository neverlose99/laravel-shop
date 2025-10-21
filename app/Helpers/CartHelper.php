<?php

namespace App\Helpers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartHelper
{
    /**
     * Lấy tổng số lượng items trong giỏ hàng của user hiện tại
     */
    public static function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }
        
        return 0;
    }

    /**
     * Lấy tổng tiền của giỏ hàng
     */
    public static function getCartTotal()
    {
        if (Auth::check()) {
            $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            return $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
        }
        
        return 0;
    }
}
