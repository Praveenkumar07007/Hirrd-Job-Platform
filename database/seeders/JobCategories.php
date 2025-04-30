<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_categories')->insert([
            ['id' => 1, 'name' => 'Software Development', 'description' => 'Programming and software engineering roles', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'IT & Operations', 'description' => 'IT infrastructure, DevOps, and system administration', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Data Science', 'description' => 'Data analysis, machine learning, and AI roles', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Security', 'description' => 'Cybersecurity and information security roles', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Game Development', 'description' => 'Video game design and development', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Product Management', 'description' => 'Product development and management roles', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Content & Documentation', 'description' => 'Technical writing and content creation', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
