<?php

namespace Callmeaf\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\User\Enums\UserStatus;
use Callmeaf\User\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasEnum
{
    use HasApiTokens, HasFactory, Notifiable,HasStatus,HasType,HasDate;

    protected $fillable = [
        'status',
        'type',
        'first_name',
        'last_name',
        'mobile',
        'national_code',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => UserStatus::class,
        'type' => UserType::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function enumsLang(): array
    {
        return __('callmeaf_user::enums');
    }
}
