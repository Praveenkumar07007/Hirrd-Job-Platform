<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create a default admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Default password: password
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create a default employer user
        User::create([
            'name' => 'Employer User',
            'email' => 'employer@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'employer',
            'email_verified_at' => now(),
        ]);

        // Create a default job seeker user
        User::create([
            'name' => 'Job Seeker User',
            'email' => 'seeker@example.com',
            'password' => Hash::make('password'),
            'user_type' => 'job_seeker',
            'email_verified_at' => now(),
        ]);

        // Create 5-10 additional random employer users
        for ($i = 0; $i < $faker->numberBetween(5, 10); $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'user_type' => 'employer',
                'email_verified_at' => now(),
            ]);
        }

        // Create 10-15 additional random job seeker users
        for ($i = 0; $i < $faker->numberBetween(10, 15); $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'user_type' => 'job_seeker',
                'email_verified_at' => now(),
            ]);
        }
    }
}
