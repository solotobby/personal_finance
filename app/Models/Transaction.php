<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = ['user_id', 'date', 'name', 'amount', 'category', 'type_id', 'category_id', 'description', 'budget_id', 'type_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function scopeFilterCategory($query, $category_id, $month, $year)
    {
        return $query->where('user_id', auth()->user()->id)->where('category_id', $category_id)
                // ->whereBetween('date', [$from, $to])
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->select('amount');
    }

    public function scopeAllTransaction($query, $category_id)
    {
        // return $query->where('user_id', auth()->user()->id)->where('category_id', $category_id)
        return $query->where('user_id', auth()->user()->id)->where('category_id', $category_id)
                //  ->whereBetween('date', [$from, $to])
                // ->whereMonth('date', $month)
                // ->whereYear('date', $year)
                ->select('amount');
    }

    public function scopeMyLatest($query, $number)
    {
        return $query->where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'DESC')->take($number);
    }

    public function scopeBetweenDates($query, $data)
    {
        if(isset($data['from']) && isset($data['to'])) {
            return $query->where('user_id', auth()->user()->id)->whereBetween('date', [$data['from'], $data['to']]);
        }
        return $query->where('user_id', auth()->user()->id);
    }
}
