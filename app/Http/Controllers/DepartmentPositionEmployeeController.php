<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class DepartmentPositionEmployeeController extends Controller
{
    public function store(Request $request, Department $department, Position $position)
    {
        $employee = Employee::query()->findOrFail($request->input('employee_id'));
        if ($employee->activePositions()->sum('positions_count') > 1.5) {
            return redirect()->back()->with('error', 'У одного сотрудника не может быть больше 1.5 ставок!');
        }
        $department->employees()->attach($employee->id, [
            'position_id' => $position->id,
            'employed_date' => $request->input('employed_date'),
            'positions_count' => $request->input('positions_count'),
        ]);
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function update(Request $request, Department $department, Position $position, Employee $employee)
    {
        if ($employee->activePositions()->sum('positions_count') > 1.5) {
            return redirect()->back()->with('error', 'У одного сотрудника не может быть больше 1.5 ставок!');
        }
        $department->employees()
            ->where('position_id', $position->id)
            ->where('employee_id', $employee->id)
            ->firstOrFail()->pivot->update($request->only(['employed_date', 'fired_date', 'positions_count']));
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Department $department, Position $position, Employee $employee)
    {
        $department->employees()->wherePivot('position_id', $position->id)->detach($employee->id);
        return redirect()->back()->with('success', 'Удалено!');
    }
}
