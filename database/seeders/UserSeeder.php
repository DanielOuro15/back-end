<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminProfile = Profile::where('name', 'admin')->first();
        $UserProfile = Profile::where('name', 'user')->first();
    
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'profile_id' => $adminProfile->id,
        ]);

        User::create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123'),
            'profile_id' => $UserProfile->id,
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('123'),
            'profile_id' => $UserProfile->id,
        ]);

        User::create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'password' => Hash::make('123'),
            'profile_id' => $UserProfile->id,
        ]);

        User::create([
            'name' => 'user4',
            'email' => 'user4@example.com',
            'password' => Hash::make('123'),
            'profile_id' => $UserProfile->id,
        ]);
    }
}
