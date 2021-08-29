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

    public function scopeFilterCategory($query, $category)
    {
        return $query->where('user_id', auth()->user()->id)->where('category', $category)->select('amount');
    }

    public function scopeMyLatest($query, $number)
    {
        return $query->where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->take($number);
    }

    public function scopeBetweenDates($query, $data)
    {
        if(isset($data['from']) && isset($data['to'])) {
            return $query->where('user_id', auth()->user()->id)->whereBetween('transaction_date', [$data['from'], $data['to']]);
        }
        return $query->where('user_id', auth()->user()->id);
    }
}
