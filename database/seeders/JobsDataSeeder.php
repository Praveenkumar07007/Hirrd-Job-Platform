<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jobs')->insert([
            [
                'title' => 'Software Engineer',
                'description' => 'Develop and maintain web applications using modern frameworks.',
                'company_id' => 1,
                'category_id' => 1,
                'location' => 'Bangalore',
                'type' => 'Full-time',
                'salary' => 90000.00,
                'deadline' => '2025-06-30',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'Design and implement UI components using React.js.',
                'company_id' => 2,
                'category_id' => 1,
                'location' => 'Remote',
                'type' => 'Full-time',
                'salary' => 85000.00,
                'deadline' => '2025-06-15',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Build APIs and handle server-side logic with Node.js and Express.',
                'company_id' => 3,
                'category_id' => 1,
                'location' => 'Mumbai',
                'type' => 'Full-time',
                'salary' => 95000.00,
                'deadline' => '2025-07-01',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Maintain CI/CD pipelines, automate deployments, and monitor infrastructure.',
                'company_id' => 4,
                'category_id' => 2,
                'location' => 'Hyderabad',
                'type' => 'Full-time',
                'salary' => 105000.00,
                'deadline' => '2025-06-25',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Full Stack Developer',
                'description' => 'Work on both frontend and backend for various projects.',
                'company_id' => 5,
                'category_id' => 1,
                'location' => 'Delhi',
                'type' => 'Full-time',
                'salary' => 100000.00,
                'deadline' => '2025-07-10',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Data Analyst',
                'description' => 'Analyze large datasets to derive actionable insights.',
                'company_id' => 1,
                'category_id' => 3,
                'location' => 'Chennai',
                'type' => 'Full-time',
                'salary' => 80000.00,
                'deadline' => '2025-06-20',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Machine Learning Engineer',
                'description' => 'Develop ML models for predictive analytics and automation.',
                'company_id' => 2,
                'category_id' => 3,
                'location' => 'Remote',
                'type' => 'Full-time',
                'salary' => 110000.00,
                'deadline' => '2025-07-15',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cloud Architect',
                'description' => 'Design cloud-based systems on AWS, Azure, or GCP.',
                'company_id' => 3,
                'category_id' => 2,
                'location' => 'Pune',
                'type' => 'Full-time',
                'salary' => 120000.00,
                'deadline' => '2025-06-30',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Cybersecurity Specialist',
                'description' => 'Monitor and secure systems from cyber threats.',
                'company_id' => 4,
                'category_id' => 4,
                'location' => 'Kolkata',
                'type' => 'Full-time',
                'salary' => 95000.00,
                'deadline' => '2025-07-05',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'QA Engineer',
                'description' => 'Test software applications to ensure quality and functionality.',
                'company_id' => 5,
                'category_id' => 1,
                'location' => 'Bangalore',
                'type' => 'Full-time',
                'salary' => 78000.00,
                'deadline' => '2025-06-18',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'React Developer',
                'description' => 'Develop scalable React apps and integrate APIs.',
                'company_id' => 1,
                'category_id' => 1,
                'location' => 'Remote',
                'type' => 'Part-time',
                'salary' => 60000.00,
                'deadline' => '2025-07-12',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Node.js Developer',
                'description' => 'Build server-side applications with Node.js and MongoDB.',
                'company_id' => 2,
                'category_id' => 1,
                'location' => 'Delhi',
                'type' => 'Full-time',
                'salary' => 92000.00,
                'deadline' => '2025-06-28',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'iOS Developer',
                'description' => 'Build and maintain iOS applications.',
                'company_id' => 3,
                'category_id' => 1,
                'location' => 'Mumbai',
                'type' => 'Full-time',
                'salary' => 99000.00,
                'deadline' => '2025-07-08',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Android Developer',
                'description' => 'Develop Android apps with Kotlin/Java.',
                'company_id' => 4,
                'category_id' => 1,
                'location' => 'Hyderabad',
                'type' => 'Full-time',
                'salary' => 97000.00,
                'deadline' => '2025-06-22',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Tech Lead',
                'description' => 'Lead a team of developers and oversee architecture decisions.',
                'company_id' => 5,
                'category_id' => 2,
                'location' => 'Bangalore',
                'type' => 'Full-time',
                'salary' => 130000.00,
                'deadline' => '2025-07-20',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Systems Analyst',
                'description' => 'Analyze system requirements and recommend improvements.',
                'company_id' => 1,
                'category_id' => 3,
                'location' => 'Pune',
                'type' => 'Full-time',
                'salary' => 88000.00,
                'deadline' => '2025-06-27',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Game Developer',
                'description' => 'Develop cross-platform games using Unity and Unreal.',
                'company_id' => 2,
                'category_id' => 5,
                'location' => 'Remote',
                'type' => 'Full-time',
                'salary' => 90000.00,
                'deadline' => '2025-07-10',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Product Manager',
                'description' => 'Define product vision, manage roadmap and coordinate dev team.',
                'company_id' => 3,
                'category_id' => 6,
                'location' => 'Delhi',
                'type' => 'Full-time',
                'salary' => 140000.00,
                'deadline' => '2025-06-29',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'AI Researcher',
                'description' => 'Conduct research in artificial intelligence and deep learning.',
                'company_id' => 4,
                'category_id' => 3,
                'location' => 'Bangalore',
                'type' => 'Full-time',
                'salary' => 150000.00,
                'deadline' => '2025-07-15',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Technical Writer',
                'description' => 'Create and manage technical documentation.',
                'company_id' => 5,
                'category_id' => 7,
                'location' => 'Remote',
                'type' => 'Part-time',
                'salary' => 70000.00,
                'deadline' => '2025-06-17',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
