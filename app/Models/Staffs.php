<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;

    protected $fillable = ['business_id', 'staff_id', 'role', 'account_number', 'account_name', 'bank_name', 'basic_salary', 'bonus', 'gross', 'status', 'recipient_code'];

}
