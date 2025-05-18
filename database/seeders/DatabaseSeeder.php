<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'herestheadmin@akbar.com',
        ]);
        // User::factory()->create([
        //     'name' => 'Test Admin',
        //     'email' => 'testAdmin@example.com',
        // ]);
        // User::factory()->create([
        //     'name' => 'Test Instructor',
        //     'email' => 'testInstructor@example.com',
        // ]);

        $this->call([
            CourseSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
        ]);
    }
}
