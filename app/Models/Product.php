<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    /**
     * Get the full image URL.
     * Handles both storage uploads and asset images.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('assets/images/products/product_1.jpg'); // Default image
        }

        // If image starts with 'products/', it's from storage upload
        if (str_starts_with($this->image, 'products/')) {
            return asset('storage/' . $this->image);
        }

        // Otherwise it's an asset image from seeder
        return asset($this->image);
    }
}
