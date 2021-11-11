<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'join_date',
        'off_date',
        'type',
        'branch_id',
        'working_part_id',
        'approver_first',
        'approver_second',
        'email',
        'email_verified_at',
        'password',
        'start_time_working',
        'end_time_working',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    public function overtimeRegisters()
    {
        return $this->hasMany(OvertimeRegister::class);
    }

    public function partimeRegisters()
    {
        return $this->hasMany(PartimeRegister::class);
    }

    public function vacations()
    {
        return $this->hasMany(Vacation::class);
    }

    public function workingParts()
    {
        return $this->hasMany(WorkingPart::class);
    }

    public function setFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
