<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id', 'amount_due', 'month', 'currency', 'payment_due_date', 'is_paid'];
}
