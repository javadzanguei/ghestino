<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPushSubscriptions;

    protected $fillable = [
        'fullname', 'mobile', 'photo', 'password', 'access', 'active',
        'superadmin', 'view_installment', 'ip', 'user_agent', 'last_login',
    ];
}
