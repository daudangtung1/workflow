<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRegister extends BaseModel
{
    public static $approvalStatus = [
        1 => '未承認',
        2 => '承認済み',
    ];

    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'approval_date',
        'approver',
        'manager_confirm',
        'start_time_working',
        'end_time_working',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function overTimeMonth()
    {
        return $this->hasOne(OvertimeMonth::class);
    }

    public function approvalByMonth()
    {
        return $this->morphOne(ApprovalByMonth::class,'modelable');
    }
}
