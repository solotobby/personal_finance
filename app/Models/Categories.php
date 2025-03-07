<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        'name',
        'description',
        'is_credit',
        'business_id'
    ];

    public function business(){
        return $this->belongsTo(Business::class);

    }
    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
