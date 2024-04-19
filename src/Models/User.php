<?php

namespace Callmeaf\User\Models;

use Callmeaf\Base\Contracts\HasResponseTitles;
use Callmeaf\Base\Traits\HasMediaMethod;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Callmeaf\Auth\Notifications\V1\VerifyEmail;
use Callmeaf\Base\Contracts\HasEnum;
use Callmeaf\Base\Traits\HasDate;
use Callmeaf\Base\Traits\HasStatus;
use Callmeaf\Base\Traits\HasType;
use Callmeaf\User\Enums\UserStatus;
use Callmeaf\User\Enums\UserType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasEnum,MustVerifyEmail,HasMedia,HasResponseTitles
{
    use HasApiTokens, HasFactory, Notifiable,HasStatus,HasType,HasDate,HasMediaMethod,InteractsWithMedia,SoftDeletes;

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

    public function fullName(): Attribute
    {
        return Attribute::get(
            fn() => $this->first_name . ' ' . $this->last_name,
        );
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail());
    }

    public function responseTitles(string $key): string
    {
        return [
            'store' => $this->fullName,
            'update' => $this->fullName,
            'status_update' => $this->fullName,
            'destroy' => $this->fullName,
            'restore' => $this->fullName,
            'force_destroy' => $this->fullName,
        ][$key];
    }

    public static function enumsLang(): array
    {
        return __('callmeaf-user::enums');
    }


}
