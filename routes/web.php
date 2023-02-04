<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentPositionController;
use App\Http\Controllers\DepartmentPositionEmployeeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MaternityLeaveController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('departments');
});
Route::prefix('departments')->group(function() {
    Route::get('/', [DepartmentController::class, 'index'])->name('departments');
    Route::get('/{department}', [DepartmentController::class, 'show'])->name('departments.view');
    Route::post('/', [DepartmentController::class, 'store'])->name('departments.create');
    Route::post('/{department}', [DepartmentController::class, 'update'])->name('departments.edit');
    Route::post('/{department}/delete', [DepartmentController::class, 'destroy'])->name('departments.delete');

    Route::post('/{department}/positions', [DepartmentPositionController::class, 'store'])->name('departments.positions.create');
    Route::get('/{department}/positions/{position}', [DepartmentPositionController::class, 'show'])->name('departments.positions.view');
    Route::post('/{department}/positions/{position}', [DepartmentPositionController::class, 'update'])->name('departments.positions.edit');
    Route::post('/{department}/positions/{position}/delete', [DepartmentPositionController::class, 'destroy'])->name('departments.positions.delete');

    Route::post('/{department}/positions/{position}/employees', [DepartmentPositionEmployeeController::class, 'store'])->name('departments.positions.employees.create');
    Route::post('/{department}/positions/{position}/employees/{employee}', [DepartmentPositionEmployeeController::class, 'update'])->name('departments.positions.employees.edit');
    Route::post('/{department}/positions/{position}/employees/{employee}/delete', [DepartmentPositionEmployeeController::class, 'destroy'])->name('departments.positions.employees.delete');
});
Route::prefix('positions')->group(function() {
    Route::get('/', [PositionController::class, 'index'])->name('positions');
    Route::post('/', [PositionController::class, 'store'])->name('positions.create');
    Route::post('/{position}', [PositionController::class, 'update'])->name('positions.edit');
    Route::post('/{position}/delete', [PositionController::class, 'destroy'])->name('positions.delete');
});
Route::prefix('employees')->group(function() {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/create', [EmployeeController::class, 'store'])->name('employees.create');
    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.view');
    Route::post('/{employee}', [EmployeeController::class, 'update'])->name('employees.edit');
    Route::post('/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');

    Route::post('/{employee}/maternity-leaves', [MaternityLeaveController::class, 'store'])->name('maternity-leaves.create');
    Route::post('/{employee}/maternity-leaves/{maternityLeave}', [MaternityLeaveController::class, 'update'])->name('maternity-leaves.edit');
    Route::post('/{employee}/maternity-leaves/{maternityLeave}/delete', [MaternityLeaveController::class, 'destroy'])->name('maternity-leaves.delete');
});
Route::prefix('reports')->group(function() {
    Route::get('/', [ReportController::class, 'index'])->name('reports');
    Route::get('/many-children', [ReportController::class, 'manyChildren'])->name('reports.many-children');
    Route::get('/child-free', [ReportController::class, 'childFree'])->name('reports.child-free');
    Route::get('/archive', [ReportController::class, 'archive'])->name('reports.archive');
    Route::get('/pensionary', [ReportController::class, 'pensionary'])->name('reports.pensionary');
    Route::get('/pre-pensionary', [ReportController::class, 'prePensionary'])->name('reports.pre-pensionary');
    Route::get('/anniversary', [ReportController::class, 'anniversary'])->name('reports.anniversary');
    Route::get('/multi-position', [ReportController::class, 'multiPosition'])->name('reports.multi-position');
    Route::get('/vacancies', [ReportController::class, 'vacancies'])->name('reports.vacancies');
    Route::get('/veterans', [ReportController::class, 'veterans'])->name('reports.veterans');
});
