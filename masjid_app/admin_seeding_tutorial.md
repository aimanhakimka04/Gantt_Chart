# Laravel Admin Seeding Tutorial

## Overview
This tutorial shows you different ways to create admin/committee accounts in Laravel using seeders.

## Method 1: Using Database Seeders (Recommended)

### Step 1: Create a Seeder
```bash
php artisan make:seeder CommitteeSeeder
```

### Step 2: Edit the Seeder File
**File:** `database/seeders/CommitteeSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Committee;
use Illuminate\Support\Facades\Hash;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple committee members
        $committees = [
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Committee Head',
                'email' => 'head@mosque.com',
                'password' => Hash::make('head123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Event Coordinator',
                'email' => 'coordinator@mosque.com',
                'password' => Hash::make('coord123'),
                'role' => 'moderator',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($committees as $committee) {
            Committee::create($committee);
        }

        $this->command->info('Committee members created successfully!');
    }
}
```

### Step 3: Register the Seeder
**File:** `database/seeders/DatabaseSeeder.php`

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CommitteeSeeder::class,
            // Add other seeders here
        ]);
    }
}
```

### Step 4: Run the Seeder
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder only
php artisan db:seed --class=CommitteeSeeder

# Fresh migration + seeding
php artisan migrate:fresh --seed
```

---

## Method 2: Using Tinker (Quick Method)

### Step 1: Open Tinker
```bash
php artisan tinker
```

### Step 2: Create Admin Account
```php
use App\Models\Committee;
use Illuminate\Support\Facades\Hash;

// Create single admin
Committee::create([
    'name' => 'Admin User',
    'email' => 'admin@admin.com',
    'password' => Hash::make('admin123'),
    'role' => 'admin',
    'email_verified_at' => now(),
]);

// Create multiple admins
$admins = [
    [
        'name' => 'Admin 1',
        'email' => 'admin1@mosque.com',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
        'email_verified_at' => now(),
    ],
    [
        'name' => 'Admin 2',
        'email' => 'admin2@mosque.com',
        'password' => Hash::make('admin123'),
        'role' => 'moderator',
        'email_verified_at' => now(),
    ],
];

foreach ($admins as $admin) {
    Committee::create($admin);
}
```

### Step 3: Exit Tinker
```bash
exit
```

---

## Method 3: Using Artisan Command (Custom Command)

### Step 1: Create Custom Command
```bash
php artisan make:command CreateAdminCommand
```

### Step 2: Edit Command File
**File:** `app/Console/Commands/CreateAdminCommand.php`

```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Committee;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {email} {password} {--role=admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin/committee member';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = $this->option('role');

        try {
            Committee::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => $role,
                'email_verified_at' => now(),
            ]);

            $this->info("Admin '{$name}' created successfully!");
            $this->info("Email: {$email}");
            $this->info("Role: {$role}");

        } catch (\Exception $e) {
            $this->error("Failed to create admin: " . $e->getMessage());
        }
    }
}
```

### Step 3: Use the Command
```bash
# Create admin
php artisan admin:create "Admin User" admin@admin.com admin123

# Create moderator
php artisan admin:create "Moderator" mod@mosque.com mod123 --role=moderator
```

---

## Method 4: Using Migration (One-time Setup)

### Step 1: Create Migration
```bash
php artisan make:migration seed_committee_members
```

### Step 2: Edit Migration File
**File:** `database/migrations/xxxx_xx_xx_xxxxxx_seed_committee_members.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Committee;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create default admin accounts
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mosque.com',
                'password' => Hash::make('super123'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event Manager',
                'email' => 'manager@mosque.com',
                'password' => Hash::make('manager123'),
                'role' => 'moderator',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($admins as $admin) {
            Committee::create($admin);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Committee::whereIn('email', [
            'superadmin@mosque.com',
            'manager@mosque.com'
        ])->delete();
    }
};
```

### Step 3: Run Migration
```bash
php artisan migrate
```

---

## Method 5: Using Factory (For Testing)

### Step 1: Create Factory
```bash
php artisan make:factory CommitteeFactory
```

### Step 2: Edit Factory File
**File:** `database/factories/CommitteeFactory.php`

```php
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Committee>
 */
class CommitteeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => fake()->randomElement(['admin', 'moderator']),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Create an admin user.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }

    /**
     * Create a moderator user.
     */
    public function moderator(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Moderator User',
            'email' => 'moderator@mosque.com',
            'password' => Hash::make('mod123'),
            'role' => 'moderator',
        ]);
    }
}
```

### Step 3: Use Factory in Seeder
```php
// In CommitteeSeeder.php
use App\Models\Committee;

public function run(): void
{
    // Create specific admin
    Committee::factory()->admin()->create();
    
    // Create specific moderator
    Committee::factory()->moderator()->create();
    
    // Create random committee members
    Committee::factory(3)->create();
}
```

---

## Best Practices

### 1. Environment-Based Seeding
```php
// In CommitteeSeeder.php
public function run(): void
{
    if (app()->environment('local', 'testing')) {
        // Create test admin
        Committee::create([
            'name' => 'Test Admin',
            'email' => 'test@admin.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
    
    if (app()->environment('production')) {
        // Create production admin
        Committee::create([
            'name' => 'Production Admin',
            'email' => 'admin@mosque.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'default123')),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
```

### 2. Check if Admin Exists
```php
public function run(): void
{
    if (!Committee::where('email', 'admin@admin.com')->exists()) {
        Committee::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('Admin created successfully!');
    } else {
        $this->command->info('Admin already exists!');
    }
}
```

### 3. Use Environment Variables
```env
# In .env file
ADMIN_EMAIL=admin@mosque.com
ADMIN_PASSWORD=secure_password_123
ADMIN_NAME=Super Admin
```

```php
// In seeder
Committee::create([
    'name' => env('ADMIN_NAME', 'Default Admin'),
    'email' => env('ADMIN_EMAIL', 'admin@admin.com'),
    'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
    'role' => 'admin',
    'email_verified_at' => now(),
]);
```

---

## Quick Commands Summary

```bash
# Create and run seeder
php artisan make:seeder CommitteeSeeder
php artisan db:seed --class=CommitteeSeeder

# Fresh database with seeding
php artisan migrate:fresh --seed

# Tinker method
php artisan tinker
# Then run PHP code to create admin

# Custom command method
php artisan make:command CreateAdminCommand
php artisan admin:create "Admin" admin@admin.com password123
```

---

## Troubleshooting

### Common Issues:
1. **Password not hashed**: Always use `Hash::make()`
2. **Email already exists**: Check for duplicates
3. **Timestamps missing**: Add `created_at` and `updated_at` if needed
4. **Foreign key errors**: Ensure related tables exist

### Verification:
```php
// Check if admin was created
php artisan tinker
Committee::all(); // Should show your created admins
```

This tutorial covers all the main methods for creating admin accounts in Laravel. Choose the method that best fits your needs!


