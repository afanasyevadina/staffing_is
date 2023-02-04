<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StaffCategorySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(DepartmentPositionSeeder::class);
        $this->call(DepartmentPositionEmployeeSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
