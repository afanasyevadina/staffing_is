@extends('layouts.app')
@section('content')
    <h1 class="mb-4">
        <a href="{{ route('reports') }}" class="text-decoration-none">Отчеты</a> / Вакансии
    </h1>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th>Кафедра</th>
            <th>Должность</th>
            <th>Количество ставок</th>
            <th>Вакансия свободна до</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departments as $department)
            @foreach($department->positions as $position)
                @if($availablePositions = $position->pivot->positions_count - $department->activeEmployees()->where('position_id', $position->id)->sum('positions_count'))
                    <tr>
                        <td>{{ $department->name }}</td>
                        <td>{{ $position->name }}</td>
                        <td>{{ $availablePositions }}</td>
                        <td>-</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        @foreach($employees as $employee)
            @foreach($employee->activePositions as $position)
                <tr>
                    <td>{{ $position->pivot->department->name }}</td>
                    <td>{{ $position->name }}</td>
                    <td>{{ $position->pivot->positions_count }}</td>
                    <td>{{ $employee->activeMaternityLeave?->end_date ? \Carbon\Carbon::create($employee->activeMaternityLeave?->end_date)->format('d.m.Y') : '-' }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
@endsection
