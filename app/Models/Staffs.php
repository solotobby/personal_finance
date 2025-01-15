<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'staff_id',
        'role',
        'account_number',
        'account_name',
        'bank_name',
        'basic_salary',
        'bonus',
        'gross',
        'status',
        'name',
        'employment_date',
        'email',
        'phone',
        'address',
        'sex',
        'date_of_birth',
        'qualification',
        'salary',
        'department',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'employment_date' => 'date',
        'date_of_birth' => 'date',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the business that owns the staff.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    protected static function booted()
    {
        static::creating(function ($staff) {

            $staff->staff_id = 'STF' . str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
        });
    }
}
