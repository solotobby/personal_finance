<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'name',
        'amount',
        'basic_salary',
        'bonus',
        'bank_name',
        'account_number',
        'account_name',
        'payer_name',
        'narration',
        'date',
        'status', // Paid, Pending, Failed
        'transaction_id',
    ];

    /**
     * Get the staff associated with the payslip.
     */
    public function staff()
    {
        return $this->belongsTo(Staffs::class, 'staff_id', 'staff_id');
    }
}
