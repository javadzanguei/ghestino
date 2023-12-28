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
        'fullname', 'mobile', 'photo', 'password', 'department_id', 'access',
        'active', 'view_all_invoices', 'superadmin', 'view_service_messages',
        'view_all_services', 'review_employees_leave', 'view_stats', 'view_installment',
        'ip', 'user_agent', 'last_login',
    ];

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function registered_cases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ServiceCase', 'registrar_user_id');
    }

    public function received_cases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ServiceCase', 'receiver_user_id');
    }

    public function delivered_cases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ServiceCase', 'delivery_user_id');
    }

    public function resulted_cases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\ServiceCase', 'service_result_registrar_user_id');
    }

    public function sent_messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'sender_id')->latest();
    }

    public function received_messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class, 'recipient_id')->latest();
    }

    public function leaves()
    {
        return $this->hasMany(EmployeeLeave::class, 'requested_by');
    }
}
