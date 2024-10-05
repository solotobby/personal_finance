<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'staff_id', 'amount', 'duration', 'repayment_amount', 'start_date', 'end_date', 'status'];

    public function staff(){
        return $this->belongsTo(Staffs::class, 'staff_id');
    }

    public function loanSchedule(){
        return $this->hasMany(LoanSchedule::class, 'loan_id');
    }
}
