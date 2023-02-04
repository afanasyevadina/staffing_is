<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class DepartmentPositionController extends Controller
{
    public function store(Request $request, Department $department)
    {
        $department->positions()->attach($request->input('position_id'), $request->only('positions_count'));
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function show(Department $department, Position $position)
    {
        return view('departments.position', [
            'department' => $department,
            'position' => $position,
            'departmentEmployees' => $department->employees()->where('position_id', $position->id)->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
            'employees' => Employee::query()->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function update(Request $request, Department $department, Position $position)
    {
        $department->positions()->where('position_id', $position->id)->firstOrFail()->pivot->update($request->only('positions_count'));
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Department $department, Position $position)
    {
        $department->positions()->detach($position->id);
        return redirect()->back()->with('success', 'Удалено!');
    }
}
