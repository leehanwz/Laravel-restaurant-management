<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * Các trường có thể fill (mass assignable)
     */
    protected $fillable = [
        'user_id',
        'check_in',       // thời gian check-in
        'check_out',      // thời gian check-out
        'date',           // ngày chấm công
        'work_minutes',   // tự tính sau khi checkout
        'note',
    ];

    /**
     * Relationship: 1 Attendance thuộc về 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
