<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends BaseModel
{
    public function scopeApprover($query, $approver)
    {
        return $query->where('id', $approver);
    }
}
