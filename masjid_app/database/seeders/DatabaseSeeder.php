<?php

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\Committee;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\MigrateUsersToParticipantsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample committee members (these are admins)
        Committee::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
   

        // Create sample participants (regular users)
        Participant::create([
            'name' => 'Test Participant',
            'email' => 'participant@example.com',
            'password' => bcrypt('password'),
            'phone' => '1234567890',
            'address' => '123 Test Street',
        ]);

        // Run the migration seeder if users table exists
        if (Schema::hasTable('users')) {
            $this->call(MigrateUsersToParticipantsSeeder::class);
        }
    }
}
