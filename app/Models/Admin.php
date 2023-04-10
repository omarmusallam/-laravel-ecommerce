<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends User
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'phone_number',
        'super_admin',
        'status',
    ];

    public function profile(){
        return $this->hasOne(Profile::class, 'admin_id', 'id')->withDefault();
    }
}