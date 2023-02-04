<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class DepartmentPositionEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department1 = Department::query()->findOrFail(1);
        $department2 = Department::query()->findOrFail(2);
        $department3 = Department::query()->findOrFail(3);
        $department1->employees()->attach(1, ['position_id' => 1, 'positions_count' => 1, 'employed_date' => '1990-05-05']);
        $department1->employees()->attach(2, ['position_id' => 2, 'positions_count' => 1, 'employed_date' => '2005-06-06', 'fired_date' => '2009-06-06']);
        $department1->employees()->attach(3, ['position_id' => 2, 'positions_count' => 1, 'employed_date' => '2015-06-06']);
        $department1->employees()->attach(4, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2020-06-06']);
        $department1->employees()->attach(5, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2018-06-06']);
        $department1->employees()->attach(6, ['position_id' => 4, 'positions_count' => 0.5, 'employed_date' => '2015-06-06']);
        $department1->employees()->attach(7, ['position_id' => 5, 'positions_count' => 0.5, 'employed_date' => '2000-06-06']);
        $department1->employees()->attach(6, ['position_id' => 6, 'positions_count' => 0.5, 'employed_date' => '2021-06-06']);

        $department2->employees()->attach(7, ['position_id' => 1, 'positions_count' => 1, 'employed_date' => '1990-05-05']);
        $department2->employees()->attach(8, ['position_id' => 2, 'positions_count' => 1, 'employed_date' => '2015-06-06']);
        $department2->employees()->attach(9, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2020-06-06']);
        $department2->employees()->attach(10, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2018-06-06']);
        $department2->employees()->attach(11, ['position_id' => 4, 'positions_count' => 1, 'employed_date' => '2015-06-06']);
        $department2->employees()->attach(12, ['position_id' => 4, 'positions_count' => 1, 'employed_date' => '1975-06-06', 'fired_date' => '1991-04-04']);
        $department2->employees()->attach(12, ['position_id' => 5, 'positions_count' => 1, 'employed_date' => '1995-06-06']);
        $department2->employees()->attach(13, ['position_id' => 6, 'positions_count' => 1, 'employed_date' => '2002-06-06']);

        $department3->employees()->attach(14, ['position_id' => 1, 'positions_count' => 1, 'employed_date' => '1990-05-05']);
        $department3->employees()->attach(15, ['position_id' => 2, 'positions_count' => 1, 'employed_date' => '2015-06-06']);
        $department3->employees()->attach(16, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2020-06-06']);
        $department3->employees()->attach(17, ['position_id' => 3, 'positions_count' => 1, 'employed_date' => '2018-06-06']);
        $department3->employees()->attach(18, ['position_id' => 4, 'positions_count' => 1, 'employed_date' => '1980-06-06']);
        $department3->employees()->attach(6, ['position_id' => 4, 'positions_count' => 0.5, 'employed_date' => '2015-06-06']);
        $department3->employees()->attach(12, ['position_id' => 4, 'positions_count' => 1, 'employed_date' => '1987-06-06', 'fired_date' => '1992-04-04']);
        $department3->employees()->attach(19, ['position_id' => 5, 'positions_count' => 1, 'employed_date' => '1975-06-06', 'fired_date' => '2009-04-04']);
        $department3->employees()->attach(20, ['position_id' => 5, 'positions_count' => 1, 'employed_date' => '1978-06-06']);
        $department3->employees()->attach(13, ['position_id' => 5, 'positions_count' => 0.5, 'employed_date' => '2019-06-06']);

        $employee1 = Employee::query()->findOrFail(3);
        $employee2 = Employee::query()->findOrFail(15);
        $employee3 = Employee::query()->findOrFail(18);
        $employee4 = Employee::query()->findOrFail(13);

        $employee1->maternityLeaves()->create(['start_date' => '2022-09-09', 'end_date' => '2024-09-09']);
        $employee2->maternityLeaves()->create(['start_date' => '2023-02-02', 'end_date' => '2025-02-02']);
        $employee3->maternityLeaves()->create(['start_date' => '1994-02-02', 'end_date' => '1996-02-02']);
        $employee4->maternityLeaves()->create(['start_date' => '2006-02-02', 'end_date' => '2008-02-02']);
    }
}
