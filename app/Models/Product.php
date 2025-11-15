<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_category_id',
        'name',
        'price',
        'size',
        'images',
        'description',
        'is_available',
        'quantity',
    ];

    protected $casts = [
        'images' => 'array',
        'is_available' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }
}
