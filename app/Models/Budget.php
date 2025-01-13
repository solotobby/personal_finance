<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = "budgets";

    protected $fillable = [
        'user_id',
        'business_id',
        'date',
        'category_id',
        'name',
        'amount',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
