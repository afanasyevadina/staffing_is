@extends('layouts.app')
@section('content')
    <h1 class="mb-4">
        <a href="{{ route('departments') }}" class="text-decoration-none">Кафедры</a> /
        <a href="{{ route('departments.view', $department->id) }}">{{ $department->name }}</a> /
        {{ $position->name }}
    </h1>
    <div class="d-flex justify-content-end">
        <a href="#" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#add">Добавить</a>
    </div>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>ИИН</th>
            <th>Количество ставок</th>
            <th>Дата трудоустройства</th>
            <th>Дата увольнения</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($departmentEmployees as $departmentEmployee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('employees.view', $departmentEmployee->id) }}" class="text-decoration-none">
                        {{ $departmentEmployee->fullName }}
                    </a>
                </td>
                <td>{{ $departmentEmployee->iin }}</td>
                <td>{{ $departmentEmployee->pivot->positions_count }}</td>
                <td>{{ $departmentEmployee->pivot->employed_date ? \Carbon\Carbon::create($departmentEmployee->pivot->employed_date)->format('d.m.Y') : '' }}</td>
                <td>{{ $departmentEmployee->pivot->fired_date ? \Carbon\Carbon::create($departmentEmployee->pivot->fired_date)->format('d.m.Y') : '-' }}</td>
                <td class="text-end text-nowrap">
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit-{{ $departmentEmployee->id }}">
                        <i class="fas fa-pen"></i>
                    </a>
                    <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete-{{ $departmentEmployee->id }}">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @foreach($departmentEmployees as $departmentEmployee)
        <div class="modal fade" tabindex="-1" id="delete-{{ $departmentEmployee->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.positions.employees.delete', [$department->id, $position->id, $departmentEmployee->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Удалить сотрудника</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Вы уверены?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="edit-{{ $departmentEmployee->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('departments.positions.employees.edit', [$department->id, $position->id, $departmentEmployee->id]) }}" method="POST" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Редактировать сотрудника</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label>Количество ставок</label>
                            <input type="number" step="0.25" min="0" max="1" name="positions_count" class="form-control" autocomplete="off" value="{{ $departmentEmployee->pivot->positions_count }}">
                        </div>
                        <div class="mb-4">
                            <label>Дата трудоустройства</label>
                            <input type="date" name="employed_date" class="form-control" autocomplete="off" value="{{ $departmentEmployee->pivot->employed_date }}">
                        </div>
                        <div class="mb-4">
                            <label>Дата увольнения</label>
                            <input type="date" name="fired_date" class="form-control" autocomplete="off" value="{{ $departmentEmployee->pivot->fired_date }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <div class="modal fade" tabindex="-1" id="add">
        <div class="modal-dialog modal-dialog-centered">
            <form action="{{ route('departments.positions.employees.create', [$department->id, $position->id]) }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Добавить позицию</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label>Сотрудник</label>
                        <select name="employee_id" class="form-control">
                            <option value="">-</option>
                            @foreach($employees->whereNotIn('id', $departmentEmployees->pluck('id')) as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->fullName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Количество ставок</label>
                        <input type="number" step="0.25" min="0" max="1" name="positions_count" class="form-control" autocomplete="off" value="1">
                    </div>
                    <div class="mb-4">
                        <label>Дата трудоустройства</label>
                        <input type="date" name="employed_date" class="form-control" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button class="btn btn-success">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
