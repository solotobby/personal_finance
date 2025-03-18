<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staffs extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

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
        'password',
        'first_login',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        'first_login' => 'boolean',
    ];

    /**
     * Get the business that owns the staff.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }


    public function getBusinessNameAttribute()
    {
        return $this->business()->exists() ? $this->business()->first()->business_name : 'Personal Finance';
    }
    protected static function booted()
    {
        static::creating(function ($staff) {
            $business = $staff->business()->first();

            if ($business && $business->name) {
                $businessName = strtoupper($business->name);
                $prefix = substr($businessName, 0, 2) . substr($businessName, -1);
            } else {
                $prefix = 'PF';
            }

            $staff->staff_id = $prefix .'/STF/'. str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
            $staff->first_login = true;
        });
    }
}
