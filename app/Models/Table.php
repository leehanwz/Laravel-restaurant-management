<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'area_id', 'seats', 'trang_thai'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
