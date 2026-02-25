<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Category, Major, User};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Test user ─────────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name'     => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // ── Categories ────────────────────────────────────────────────────────
        $science = Category::firstOrCreate(
            ['slug' => 'science'],
            ['name' => 'Science', 'description' => 'Natural and physical sciences']
        );

        $engineering = Category::firstOrCreate(
            ['slug' => 'engineering'],
            ['name' => 'Engineering', 'description' => 'Engineering and technology']
        );

        $arts = Category::firstOrCreate(
            ['slug' => 'arts'],
            ['name' => 'Arts', 'description' => 'Arts and humanities']
        );

        $business = Category::firstOrCreate(
            ['slug' => 'business'],
            ['name' => 'Business', 'description' => 'Business and management']
        );

        // ── Majors ────────────────────────────────────────────────────────────
        Major::firstOrCreate(
            ['name' => 'Computer Science'],
            [
                'description'   => 'Computer Science is the study of computation, information, and automation. It includes both theoretical and practical disciplines.',
                'category_id'   => $engineering->id,
                'duration_years' => 4,
                'is_active'     => true,
            ]
        );

        Major::firstOrCreate(
            ['name' => 'Biology'],
            [
                'description'   => 'Biology is the scientific study of life and living organisms, including their structure, function, growth, evolution, and distribution.',
                'category_id'   => $science->id,
                'duration_years' => 4,
                'is_active'     => true,
            ]
        );

        Major::firstOrCreate(
            ['name' => 'Business Administration'],
            [
                'description'   => 'Business Administration covers the performance or management of business operations and decision-making.',
                'category_id'   => $business->id,
                'duration_years' => 4,
                'is_active'     => true,
            ]
        );

        Major::firstOrCreate(
            ['name' => 'Psychology'],
            [
                'description'   => 'Psychology is the scientific study of mind and behavior, including conscious and unconscious phenomena.',
                'category_id'   => $science->id,
                'duration_years' => 4,
                'is_active'     => true,
            ]
        );

        Major::firstOrCreate(
            ['name' => 'Mechanical Engineering'],
            [
                'description'   => 'Mechanical Engineering is the study of physical machines that may involve force and movement.',
                'category_id'   => $engineering->id,
                'duration_years' => 4,
                'is_active'     => true,
            ]
        );

        // ── Universities (Cambodia) ───────────────────────────────────────────
        $this->call(CambodiaUniversitySeeder::class);
        $this->call(CambodiaMajorSeeder::class);
    }
}