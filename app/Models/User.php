<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Các trường có thể fill (mass assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'code',      // mã nhân viên
        'position',  // chức vụ
        'role',      // quyền: admin/employee
        'status',    // active/inactive
    ];

    /**
     * Các trường ẩn khi serialize (ví dụ trả JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các kiểu dữ liệu cần cast
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship: 1 User có nhiều Attendance (chấm công)
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
