<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    // Các cột có thể fill
    protected $fillable = [
        'menu_category_id',
        'name',
        'price',
        'flavor',
        'type',       // cồn/không cồn, có ga/không ga
        'images',     // JSON
        'description',
    ];

    // Cast JSON thành array tự động
    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Quan hệ Drink thuộc về danh mục
     */
    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
