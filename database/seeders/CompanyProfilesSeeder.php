<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CompanyProfile;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\File;

class CompanyProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $employers = User::where('user_type', 'employer')->get();

        if ($employers->isEmpty()) {
            $this->command->info('No employer users found to assign company profiles to. Please seed employer users first.');
            return;
        }

        // Ensure the target directory exists and is writable
        $storagePath = storage_path('app/public/company_logos');
        if (!File::isDirectory($storagePath)) {
            File::makeDirectory($storagePath, 0755, true, true);
        }

        // Create 10-15 company profiles
        for ($i = 0; $i < $faker->numberBetween(10, 15); $i++) {
            // Use storage_path() for the directory where Faker saves the file
            $imagePath = $faker->image($storagePath, 640, 480, 'business', false);
            // Store the relative path suitable for the public disk
            $relativePath = 'company_logos/' . basename($imagePath);

            CompanyProfile::create([
                'user_id' => $employers->random()->id,
                'name' => $faker->company,
                'description' => $faker->paragraph(3),
                'website' => $faker->optional()->url,
                'logo' => $relativePath, // Store relative path
                'location' => $faker->city . ', ' . $faker->stateAbbr,
            ]);
        }
    }
}
