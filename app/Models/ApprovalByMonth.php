<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalByMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelable_type',
        'modelable_id',
        'date'
    ];
}
