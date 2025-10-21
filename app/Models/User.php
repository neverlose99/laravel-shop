<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Thêm hằng số (constants) để code dễ đọc
     */
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     * Thêm 'role' vào đây
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <-- THÊM VÀO
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * ✅ THÊM HÀM NÀY VÀO
     * Hàm này kiểm tra xem người dùng có phải là Admin không.
     */
    public function isAdmin(): bool
    {
        // So sánh cột 'role' của user với hằng số ROLE_ADMIN
        return $this->role == self::ROLE_ADMIN;
    }
}