<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParttimeMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
    ];

    public function parttimeRegisterMonth()
    {
        return $this->belongsTo(ParttimeRegister::class);
    }

    public function parttimeMonth()
    {
        return $this->hasOne(ParttimeMonth::class);
    }
}
