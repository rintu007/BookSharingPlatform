<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $centerLat = 40.72;
        $centerLng = -74.11;

        $coords = randomCoordinatesAround($centerLat, $centerLng, 1, 12);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'latitude' => $coords['latitude'],
            'longitude' => $coords['longitude'],
        ];
    }
}
