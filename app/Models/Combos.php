<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combos extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'gift_items',
        'image',
    ];

    protected $casts = [
        'gift_items' => 'array', // để JSON tự động cast thành array
    ];

    /**
     * Lấy tất cả các sản phẩm trong combo
     */
    // Combos.php
    public function products()
    {
        return $this->belongsToMany(Product::class, 'combo_items', 'combo_id', 'product_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
