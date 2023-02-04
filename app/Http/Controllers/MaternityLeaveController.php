<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\MaternityLeave;
use Illuminate\Http\Request;

class MaternityLeaveController extends Controller
{
    public function store(Request $request, Employee $employee)
    {
        $employee->maternityLeaves()->create($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function update(Request $request, Employee $employee, MaternityLeave $maternityLeave)
    {
        $maternityLeave->update($request->all());
        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy(Employee $employee, MaternityLeave $maternityLeave)
    {
        $maternityLeave->delete();
        return redirect()->back()->with('success', 'Удалено!');
    }
}
