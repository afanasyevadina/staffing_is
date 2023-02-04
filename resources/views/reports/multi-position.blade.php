@extends('layouts.app')
@section('content')
    <h1 class="mb-4">
        <a href="{{ route('reports') }}" class="text-decoration-none">Отчеты</a> / Больше одной ставки
    </h1>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>ИИН</th>
            <th>Дата рождения</th>
            <th>Дата трудоустройства</th>
            <th>Должности</th>
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
                <td>{{ $employee->employedDate ? \Carbon\Carbon::create($employee->employedDate)->format('d.m.Y') : '' }}</td>
                <td>
                    @foreach($employee->activePositions as $position)
                        <div>{{ $position->name }} - {{ $position->pivot->department->name }}, {{ $position->pivot->positions_count }} ст.</div>
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
