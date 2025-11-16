<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ComboItem extends Pivot
{
    use HasFactory;

    protected $table = 'combo_items';

    protected $fillable = [
        'combo_id',
        'product_id',
        'quantity',
    ];
}
