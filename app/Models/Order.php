<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'status',
        'payment_method',
        'payment_status',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'district',
        'ward',
        'note',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generate unique order number
    public static function generateOrderNumber()
    {
        do {
            $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    // Status badge HTML
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="badge bg-warning">Chờ xử lý</span>',
            'processing' => '<span class="badge bg-info">Đang xử lý</span>',
            'completed' => '<span class="badge bg-success">Hoàn thành</span>',
            'cancelled' => '<span class="badge bg-danger">Đã hủy</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    // Payment status badge HTML
    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'unpaid' => '<span class="badge bg-danger">Chưa thanh toán</span>',
            'paid' => '<span class="badge bg-success">Đã thanh toán</span>',
        ];

        return $badges[$this->payment_status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    // Format datetime cho Việt Nam
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s');
    }

    // Hiển thị thời gian theo kiểu "2 giờ trước"
    public function getTimeAgoAttribute()
    {
        return $this->created_at->timezone('Asia/Ho_Chi_Minh')->diffForHumans();
    }
}
