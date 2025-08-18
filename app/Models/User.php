<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'latitude', 'longitude',
    ];

    protected $hidden = [
        'password', 'remember_token',   'created_at',
        'updated_at',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
