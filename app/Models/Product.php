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

    
    public function combos()
    {
        return $this->belongsToMany(Combos::class, 'combo_items', 'product_id', 'combo_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
