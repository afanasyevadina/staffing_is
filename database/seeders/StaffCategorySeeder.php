<?php

namespace Database\Seeders;

use App\Models\StaffCategory;
use Illuminate\Database\Seeder;

class StaffCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaffCategory::query()->insert([
            ['name' => 'администрация'],
            ['name' => 'преподавательский и инженерно-технический состав'],
            ['name' => 'технический персонал'],
        ]);
    }
}
