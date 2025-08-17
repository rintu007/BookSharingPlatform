<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;


    // Admin model definition
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    // Optional: Automatically generate the admin token on login or registration
    protected $hidden = ['password', 'remember_token'];

    public $timestamps = false;
}
