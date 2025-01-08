<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'business_name',
        'business_email',
        'business_description',
        'user_id',
        'business_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function staffs(){
        return $this->hasMany(Staffs::class);
    }

    protected static function booted()
    {
        static::creating(function ($business) {

            $business->business_id = 'PF' . str_pad(rand(10000, 99999), 5, '0', STR_PAD_LEFT);
        });
    }
}
