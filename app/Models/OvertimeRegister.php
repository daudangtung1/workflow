<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeRegister extends BaseModel
{
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
}
