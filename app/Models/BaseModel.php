<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BaseModel extends Model
{
    public function userApprover()
    {
        return $this->belongsTo(User::class, 'approver');
    }
}
