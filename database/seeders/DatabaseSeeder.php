<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TrainerProfile;
use App\Models\PersonalDocument;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create Trainer Profile
        $trainerProfile = TrainerProfile::factory()->create([
            'user_id' => $user->id,
        ]);

        // Seed Personal Documents
        PersonalDocument::factory(5)->create([
            'profile_id' => $trainerProfile->id,
            'user_id' => $user->id,
        ]);
    }
}
