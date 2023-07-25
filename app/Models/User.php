<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Adldap\Laravel\Traits\HasLdapUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasLdapUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'objectguid',
        'name',
        'username',
        'password',
        'ou',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function demands()
    {
        return $this->hasMany(Ticket::class, 'user_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'referred_id', 'id');
    }

    public function sendSms()
    {
        return $this->hasMany(Sms::class, 'sender_user_id', 'id');
    }

    public function receiveSms()
    {
        return $this->hasMany(Sms::class, 'receiver_user_id', 'id');
    }
}
