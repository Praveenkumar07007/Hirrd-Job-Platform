<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\CompanyProfile;
use App\Models\JobCategory;
use Faker\Factory as Faker;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $companies = CompanyProfile::all();
        $categories = JobCategory::all();

        if ($companies->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Please seed companies and job categories before seeding jobs.');
            return;
        }

        $jobTypes = ['full-time', 'part-time', 'contract', 'internship', 'remote'];

        // Create 15-25 jobs
        for ($i = 0; $i < $faker->numberBetween(15, 25); $i++) {
            Job::create([
                'title' => $faker->jobTitle,
                'description' => $faker->paragraphs(3, true),
                'company_id' => $companies->random()->id,
                'category_id' => $categories->random()->id,
                'location' => $faker->city . ', ' . $faker->stateAbbr,
                'type' => $faker->randomElement($jobTypes),
                'salary' => $faker->optional(0.7)->numberBetween(40000, 150000), // 70% chance of having a salary
                'deadline' => $faker->optional(0.8)->dateTimeBetween('+1 week', '+3 months'), // 80% chance of having a deadline
                'is_active' => $faker->boolean(85), // 85% chance of being active
            ]);
        }
    }
}
