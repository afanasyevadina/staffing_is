<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('departments.index', [
            'departments' => Department::query()->withCount('positions')->withCount('activeEmployees')->orderBy('name')->get(),
        ]);
    }

    public function show(Department $department)
    {
        return view('departments.view', [
            'department' => $department,
            'positions' => Position::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        Department::query()->create($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function update(Request $request, Department $department)
    {
        $department->update($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->back()->with('success', 'Удалено!');
    }
}
