<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class MigrateToNewUserSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:new-user-system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate from old user system to new participant/committee system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting migration to new user system...');

        try {
            // Check if users table exists
            if (!Schema::hasTable('users')) {
                $this->error('Users table does not exist. Migration cannot proceed.');
                return 1;
            }

            // Run migrations to create new tables
            $this->info('Creating new tables...');
            Artisan::call('migrate', ['--path' => 'database/migrations/2025_01_20_000000_create_participants_table.php']);
            Artisan::call('migrate', ['--path' => 'database/migrations/2025_01_20_000001_create_committees_table.php']);

            // Run data migration seeder
            $this->info('Migrating existing user data...');
            Artisan::call('db:seed', ['--class' => 'MigrateUsersToParticipantsSeeder']);

            // Update foreign key references
            $this->info('Updating foreign key references...');
            Artisan::call('migrate', ['--path' => 'database/migrations/2025_01_20_000002_update_registrations_table.php']);
            Artisan::call('migrate', ['--path' => 'database/migrations/2025_01_20_000003_update_service_requests_table.php']);

            // Drop old users table
            $this->info('Dropping old users table...');
            Artisan::call('migrate', ['--path' => 'database/migrations/2025_01_20_000004_drop_users_table.php']);

            $this->info('Migration completed successfully!');
            $this->info('New system is now active with participants and committees.');

        } catch (\Exception $e) {
            $this->error('Migration failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}











