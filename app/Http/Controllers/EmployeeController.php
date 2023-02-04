<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::query()->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function show(Employee $employee)
    {
        return view('employees.view', [
            'employee' => $employee,
        ]);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = Employee::query()->create($request->all());
        return redirect()->route('employees.view', $employee->id)->with('success', 'Сохранено!');
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back()->with('success', 'Удалено!');
    }
}
