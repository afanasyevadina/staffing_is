<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Department::all() as $department) {
            $department->positions()->attach(1, ['positions_count' => 1]);
            $department->positions()->attach(2, ['positions_count' => 1]);
            $department->positions()->attach(3, ['positions_count' => 5]);
            $department->positions()->attach(4, ['positions_count' => 3]);
            $department->positions()->attach(5, ['positions_count' => 2]);
            $department->positions()->attach(6, ['positions_count' => 2]);
        }
    }
}
