<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    // Cho phép fill tên và loại danh mục
    protected $fillable = [
        'name',
        'type', // 'food' hoặc 'drink'
    ];

    /**
     * Quan hệ 1 danh mục có nhiều món ăn
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Quan hệ 1 danh mục có nhiều đồ uống
     */
    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }
}
