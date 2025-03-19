<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'task_id',
        'title',
        'description',
        'staff_id',
        'priority',
        'status',
        'due_date',
        'completion_date',
        'created_by'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staffs::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($task) {
            if (empty($task->task_id)) {
                $task->task_id = 'Tk' . mt_rand(100000, 999999);
            }
        });
    }
}
