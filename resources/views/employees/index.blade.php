@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-4">Сотрудники</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-success mb-4">Добавить</a>
    </div>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>ИИН</th>
            <th>Дата рождения</th>
            <th>Количество ставок</th>
            <th>Дата трудоустройства</th>
            <th>Дата увольнения</th>
        </tr>
        </thead>
        <tbody>
        @forelse($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                    <a href="{{ route('employees.view', $employee->id) }}" class="text-decoration-none">
                        {{ $employee->fullName }}
                    </a>
                </td>
                <td>{{ $employee->iin }}</td>
                <td>{{ $employee->birthday ? \Carbon\Carbon::create($employee->birthday)->format('d.m.Y') : '' }}</td>
                <td>{{ $employee->activePositions()->sum('positions_count') }}</td>
                <td>{{ $employee->employedDate ? \Carbon\Carbon::create($employee->employedDate)->format('d.m.Y') : '' }}</td>
                <td>{{ $employee->firedDate ? \Carbon\Carbon::create($employee->firedDate)->format('d.m.Y') : '' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
