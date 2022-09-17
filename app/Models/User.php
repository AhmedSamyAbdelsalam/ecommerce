<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, EntrustUserWithPermissionsTrait ,searchableTrait;

    protected $fillable = [
        'first_name','last_name','username','email','mobile', 'email_verified_at', 'password', 'user_image', 'status', 'receive_email','remember_token',
    ];

    protected $appends = ['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $searchable = [
        'columns' => [
            'users.first_name' => 10,
            'users.last_name' => 10,
            'users.username' => 10,
            'users.email' => 10,
        ],
    ];

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'App.Models.User.' . $this->id;
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute(): string
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function reviews():HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function status()
    {
        return $this->status ? 'Active' : 'Inactive' ;
    }

    public function addresses():HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function orders():HasMany
    {
        return $this->hasMany(order::class);
    }

}
