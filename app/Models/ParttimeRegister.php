<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParttimeRegister extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time_first',
        'end_time_first',
        'start_time_second',
        'end_time_second',
        'start_time_third',
        'end_time_third',
        'approval_date',
        'approver',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvalByMonth()
    {
        return $this->morphOne(ApprovalByMonth::class,'modelable');
    }
}
