<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Position::query()->insert([
            ['name' => 'Заведующий кафедрой', 'staff_category_id' => 1, 'salary' => 500000],
            ['name' => 'Секретарь', 'staff_category_id' => 1, 'salary' => 250000],
            ['name' => 'Преподаватель', 'staff_category_id' => 2, 'salary' => 300000],
            ['name' => 'Старший преподаватель', 'staff_category_id' => 2, 'salary' => 350000],
            ['name' => 'Профессор', 'staff_category_id' => 2, 'salary' => 400000],
            ['name' => 'Системный администратор', 'staff_category_id' => 3, 'salary' => 250000],
        ]);
    }
}
