<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'option',
        'reason',
        'approval_date',
        'approver',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
