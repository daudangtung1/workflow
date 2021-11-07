<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingPart extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(User::class, 'branch_id');
    }
}
