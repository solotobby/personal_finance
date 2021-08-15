<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = ['user_id', 'transaction_date', 'name', 'amount', 'category', 'type', 'category_id', 'description', 'from_budget'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
