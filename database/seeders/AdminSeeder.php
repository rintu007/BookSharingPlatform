<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Str;
use Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',  // Use your admin email
            'password' => Hash::make('admin_password'),  // Default password for the admin
            'api_token' => Str::random(60),  // Generating a random API token for the admin
        ]);

        // Optionally, you can log or print something to confirm it's created
        $this->command->info('Admin user created!');
    }
}
