<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function manyChildren()
    {
        return view('reports.many-children', [
            'employees' => Employee::query()->active()->where('children_count', '>', 3)->orderByDesc('children_count')->get(),
        ]);
    }

    public function childFree()
    {
        return view('reports.child-free', [
            'employees' => Employee::query()->active()->whereNull('children_count')->orWhere('children_count', 0)->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function archive()
    {
        return view('reports.archive', [
            'employees' => Employee::query()->whereHas('positions')->whereDoesntHave('activePositions')->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function pensionary()
    {
        return view('reports.pensionary', [
            'employees' => Employee::query()->active()->where(function (Builder $query) {
                $query->where('gender', 0)->whereDate('birthday', '<=', now()->subYears(63));
            })->orWhere(function (Builder $query) {
                $query->where('gender', 1)->whereDate('birthday', '<=', now()->subYears(61));
            })->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function prePensionary()
    {
        return view('reports.pre-pensionary', [
            'employees' => Employee::query()->active()->where(function (Builder $query) {
                $query->where('gender', 0)->whereDate('birthday', '<=', now()->subYears(61))->whereDate('birthday', '>=', now()->subYears(63));
            })->orWhere(function (Builder $query) {
                $query->where('gender', 1)->whereDate('birthday', '<=', now()->subYears(59))->whereDate('birthday', '>=', now()->subYears(61));
            })->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function anniversary()
    {
        return view('reports.anniversary', [
            'employees' => Employee::query()->active()->where(function (Builder $query) {
                $query->whereYear('birthday', now()->subYears(120)->format('Y'));
                for ($age = 120; $age >= 0; $age -= 10) {
                    $query->orWhereYear('birthday', now()->subYears($age)->format('Y'));
                }
            })->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function multiPosition()
    {
        return view('reports.multi-position', [
            'employees' => Employee::query()->active()->has('activePositions', '>=', 2)->orderBy('last_name')->orderBy('first_name')->orderBy('middle_name')->get(),
        ]);
    }

    public function vacancies()
    {
        return view('reports.vacancies', [
            'departments' => Department::query()->with('positions')->get(),
            'employees' => Employee::query()->active()->whereHas('activeMaternityLeave')->get(),
        ]);
    }

    public function veterans()
    {
        return view('reports.veterans', [
            'employees' => Employee::query()->whereHas('positions', function (Builder $query) {
                $query->whereDate('employed_date', '<=', now()->subYears(30));
            })->get()->filter(fn (Employee $employee) => $employee->experience?->format('o') >= 30),
        ]);
    }
}
