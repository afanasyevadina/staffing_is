@extends('layouts.app')
@section('content')
    <h1 class="mb-4">
        <a href="{{ route('reports') }}" class="text-decoration-none">Отчеты</a> / Многодетные сотрудники
    </h1>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>ИИН</th>
            <th>Количество детей</th>
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
                <td>{{ $employee->children_count }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center table-light">Пока ничего</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
