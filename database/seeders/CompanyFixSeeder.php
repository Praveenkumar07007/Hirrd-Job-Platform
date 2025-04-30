<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if companies 1-5 exist, if not create them
        for ($i = 1; $i <= 5; $i++) {
            $exists = DB::table('company_profiles')->where('id', $i)->exists();

            if (!$exists) {
                DB::table('company_profiles')->insert([
                    'id' => $i,
                    'user_id' => DB::table('users')->where('user_type', 'employer')->inRandomOrder()->first()->id ?? 1,
                    'name' => 'Company ' . $i,
                    'description' => 'This is company ' . $i,
                    'location' => 'Location ' . $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
