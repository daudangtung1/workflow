<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'type',
        'approval_date',
        'approver',
        'start_time',
        'end_time',
        'total_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
