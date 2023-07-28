<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\StudentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        \App\Models\User::factory(10)->create()->each(function($user) {
             $user->assignRole('teacher');
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::factory()->create([
            'name' => 'scientific',
        ]);
        Category::factory()->create([
            'name' => 'literary',
        ]);
        $this->call(StudentSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(SchoolClassSeeder::class);
    }
}
