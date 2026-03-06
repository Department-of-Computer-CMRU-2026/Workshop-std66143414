<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
        ['email' => 'admin@example.com'],
        [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]
        );

        // Create Sample Student User
        User::updateOrCreate(
        ['email' => 'student@example.com'],
        [
            'name' => 'Sample Student',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]
        );

        // Create Sample Activities
        $activities = [
            [
                'name' => 'AI and Future of Web Development',
                'speaker' => 'Dr. Smith',
                'location' => 'Room 101',
                'total_seats' => 50,
            ],
            [
                'name' => 'Laravel 12 Deep Dive',
                'speaker' => 'Taylor Otwell',
                'location' => 'Main Hall',
                'total_seats' => 100,
            ],
            [
                'name' => 'UI/UX Design Masterclass',
                'speaker' => 'Jane Doe',
                'location' => 'Design Lab',
                'total_seats' => 30,
            ],
            [
                'name' => 'Cybersecurity Essentials',
                'speaker' => 'Kevin Mitnick',
                'location' => 'Security Hub',
                'total_seats' => 2, // Small amount to test "Full" state
            ],
        ];

        foreach ($activities as $activity) {
            Activity::updateOrCreate(
            ['name' => $activity['name']],
                $activity
            );
        }
    }
}
