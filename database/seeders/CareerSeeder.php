<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Senior RCC Core Cutting Technician',
                'department' => 'Operations',
                'location' => 'Lahore',
                'job_type' => 'Full-time',
                'salary_range' => 'PKR 60,000 - 80,000',
                'experience' => '3-5 Years',
                'qualification' => 'DAE Civil / Technical Diploma',
                'description' => '<p>We are looking for an experienced RCC Core Cutting Technician to join our team...</p><ul><li>Operate core cutting machines</li><li>Ensure safety protocols</li><li>Supervise junior technicians</li></ul>',
                'requirements' => '<ul><li>3+ years experience in RCC core cutting</li><li>Knowledge of diamond drilling</li><li>Valid driving license</li></ul>',
                'benefits' => '<ul><li>Health insurance</li><li>Overtime pay</li><li>Transport allowance</li></ul>',
                'sort_order' => 1,
            ],
            [
                'title' => 'Plumbing Supervisor',
                'department' => 'Plumbing',
                'location' => 'Islamabad',
                'job_type' => 'Full-time',
                'salary_range' => 'PKR 50,000 - 70,000',
                'experience' => '2-4 Years',
                'qualification' => 'DAE / Diploma in Plumbing',
                'description' => '<p>Seeking a skilled Plumbing Supervisor for residential and commercial projects...</p>',
                'requirements' => '<ul><li>2+ years supervisory experience</li><li>Knowledge of modern plumbing systems</li></ul>',
                'benefits' => '<ul><li>Accommodation provided</li><li>Annual bonus</li></ul>',
                'sort_order' => 2,
            ],
            [
                'title' => 'Fire Fighting System Engineer',
                'department' => 'Fire Safety',
                'location' => 'Karachi',
                'job_type' => 'Full-time',
                'salary_range' => 'PKR 70,000 - 100,000',
                'experience' => '4-6 Years',
                'qualification' => 'B.E / B.Tech Mechanical',
                'description' => '<p>We need a Fire Fighting System Engineer to design and install fire safety systems...</p>',
                'requirements' => '<ul><li>NFPA certification preferred</li><li>Experience with sprinkler systems</li></ul>',
                'benefits' => '<ul><li>Company vehicle</li><li>Medical coverage for family</li></ul>',
                'sort_order' => 3,
            ],
            [
                'title' => 'Diamond Drilling Operator',
                'department' => 'Operations',
                'location' => 'Lahore',
                'job_type' => 'Full-time',
                'salary_range' => 'PKR 40,000 - 55,000',
                'experience' => '1-3 Years',
                'qualification' => 'Matric / Technical Training',
                'description' => '<p>Looking for Diamond Drilling Operators for ongoing projects in Lahore...</p>',
                'requirements' => '<ul><li>Experience with Hilti DD series</li><li>Physical fitness required</li></ul>',
                'benefits' => '<ul><li>Training provided</li><li>Career growth opportunities</li></ul>',
                'sort_order' => 4,
            ],
            [
                'title' => 'Civil Site Supervisor',
                'department' => 'Construction',
                'location' => 'Multan',
                'job_type' => 'Contract',
                'salary_range' => 'PKR 45,000 - 60,000',
                'experience' => '2-5 Years',
                'qualification' => 'DAE Civil',
                'description' => '<p>Site Supervisor needed for construction projects in Multan region...</p>',
                'requirements' => '<ul><li>AutoCAD knowledge</li><li>Team management skills</li></ul>',
                'benefits' => '<ul><li>Site allowance</li><li>Contract completion bonus</li></ul>',
                'sort_order' => 5,
            ],
            [
                'title' => 'Sales Executive - Engineering Equipment',
                'department' => 'Sales',
                'location' => 'Lahore',
                'job_type' => 'Full-time',
                'salary_range' => 'PKR 35,000 - 50,000 + Commission',
                'experience' => '1-3 Years',
                'qualification' => 'BBA / B.Com',
                'description' => '<p>Sales Executive required for our engineering equipment division...</p>',
                'requirements' => '<ul><li>Knowledge of construction equipment</li><li>Valid driving license</li></ul>',
                'benefits' => '<ul><li>Commission structure</li><li>Travel allowance</li></ul>',
                'sort_order' => 6,
            ],
        ];

        foreach ($jobs as $job) {
            $job['slug'] = Str::slug($job['title']);
            $job['is_active'] = true;
            $job['closing_date'] = now()->addDays(30);
            Career::create($job);
        }

        $this->command->info('Career jobs seeded successfully!');
    }
}