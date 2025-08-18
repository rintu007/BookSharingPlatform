<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'user_id'];

    protected $hidden = ['user_id', 'created_at', 'updated_at']; // hide user_id from JSON

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Scope to find nearby books excluding the current user's books
     */
    public function scopeNearby($query, $latitude, $longitude, $distance = 10)
    {
        return $query->select('books.*')
            ->selectRaw('ST_Distance_Sphere(point(users.longitude, users.latitude), point(?, ?)) / 1000 AS distance_km', [$longitude, $latitude])
            ->join('users', 'books.user_id', '=', 'users.id')
            ->where('books.user_id', '!=', auth()->id())
            ->having('distance_km', '<', $distance);

    }
}
