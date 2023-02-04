<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::query()->insert([
            ['name' => 'Информационные технологии'],
            ['name' => 'Высшая математика и информационное моделирование'],
            ['name' => 'Физика и приборостроение'],
        ]);
    }
}
